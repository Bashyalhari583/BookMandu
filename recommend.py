
from flask import Flask,request,jsonify
from flask_mysqldb import MySQL
import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity



app = Flask(__name__)

app.config['MYSQL_HOST']  = "localhost"
app.config['MYSQL_USER']  = "root"
app.config['MYSQL_PASSWORD']  = ""
app.config['MYSQL_DB']  = "bookmandu"

mysql = MySQL(app)

def getVectorizer():
     return TfidfVectorizer(stop_words='english')

def getAllBooksX(user_id):
    cursor = mysql.connection.cursor()

    cursor.execute(f"SELECT books.name,books.city,books.description,c.name as category,books.id from books join categories c on c.id = books.category_id where books.user_id != '{user_id}' and books.state = 'active' and books.is_available = 1 ")

    books = cursor.fetchall()

    # print(books)
    cursor.close()
    return books


def getUsersPreferenceY(user_id,book_id):
    
    cursor = mysql.connection.cursor()

    if(book_id):
        print("From current book")
        cursor.execute(f"SELECT books.name,books.city,books.description,c.name as category,books.id from books join categories c on c.id = books.category_id where books.user_id != '{user_id}' and books.state = 'active' and books.is_available = 1 and books.id = {book_id} ")
    else:
        print("From current user details")
        cursor.execute(f"select s.name,s.city,s.description,c.name as category from (SELECT b.name,b.city,b.description,b.category_id from book_views v join books b on v.post_id = b.id where v.user_id = '{user_id}') s join categories c on c.id = s.category_id ")

    books = cursor.fetchall()

    # print(books)
    cursor.close()
    return books
    

def calcuateYVectors(vectorizer,booksData):

    df = pd.DataFrame(booksData)
    df['text'] = df[0] + ' ' + df[1] + ' ' + df[2] + " "+ df[3]
    tfidf_vector =  vectorizer.transform(df['text'])

    good_view = pd.DataFrame(tfidf_vector.toarray(),columns=vectorizer.get_feature_names_out())
    # print(good_view)
    return tfidf_vector
 

def calculateXVectors(vectorizer,books):


    df = pd.DataFrame(books)


    df['text'] = df[0] + ' ' + df[1] + ' ' + df[2]+ " "+ df[3]

    tfidf_vector =  vectorizer.fit_transform(df['text'])

    better_view = pd.DataFrame(tfidf_vector.toarray(),columns=vectorizer.get_feature_names_out() )
    # print(better_view)
    
    return tfidf_vector

def calculateCosineSimilarity(x_vector,y_vector):
    similarity = cosine_similarity(x_vector,y_vector)

    np_smilarity = np.array(similarity)

    eachRowSimilarity = np.sum(np_smilarity,axis=1)
    # print(eachRowSimilarity)

    return eachRowSimilarity


@app.route('/show/similar',methods=["GET"])
def similar():
    user_id = request.args.get('user_id')
    book_id = request.args.get('book_id')
    if not user_id:
        return "Please provide user_id"
    
    
    vectorizer = getVectorizer()
    
    booksX = getAllBooksX(user_id)
    userDataY = getUsersPreferenceY(user_id,book_id)
    if(  len(userDataY)==0 ):
        ids = []
        for i in range( len(booksX)  ):
            ids.append(  booksX[i][4]   )
        return jsonify(ids)

    x_vector = calculateXVectors(vectorizer,booksX)
    y_vector = calcuateYVectors(vectorizer,userDataY)

    similarities = calculateCosineSimilarity(x_vector,y_vector)

        
    rowSimilarityWithBook = list( zip(booksX,similarities) )

    sortedSimilairtyWithBook = sorted(rowSimilarityWithBook,key=lambda x: x[1],reverse=True)
    
    for i in range(len(sortedSimilairtyWithBook)):
        if(i==0):continue
        print(f"{i}. {sortedSimilairtyWithBook[i][0][0]} matches {sortedSimilairtyWithBook[i][1]} ")

    sorted_books, sorted_scores = zip(*sortedSimilairtyWithBook)

    ids = []
    for i in range(len(sorted_books)):
        ids.append(  sorted_books[i][4] )

    
    return jsonify( ids   )


app.run(port=3000)



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

    cursor.execute(f"SELECT name,city,description,id from books where user_id != '{user_id}' and state = 'active' and is_available = 1 ")

    books = cursor.fetchall()

    # print(books)
    cursor.close()
    return books


def getUsersPreferenceY(user_id):
    
    cursor = mysql.connection.cursor()

    cursor.execute(f"SELECT b.name,b.city,b.description from book_views v join books b on v.post_id = b.id where v.user_id = '{user_id}'")

    books = cursor.fetchall()

    # print(books)
    cursor.close()
    return books
    

def calcuateYVectors(vectorizer,booksData):

    df = pd.DataFrame(booksData)
    df['text'] = df[0] + ' ' + df[1] + ' ' + df[2]
    tfidf_vector =  vectorizer.transform(df['text'])

    good_view = pd.DataFrame(tfidf_vector.toarray(),columns=vectorizer.get_feature_names_out())
    print(good_view)
    return tfidf_vector
 

def calculateXVectors(vectorizer,books):


    df = pd.DataFrame(books)


    df['text'] = df[0] + ' ' + df[1] + ' ' + df[2]

    tfidf_vector =  vectorizer.fit_transform(df['text'])

    better_view = pd.DataFrame(tfidf_vector.toarray(),columns=vectorizer.get_feature_names_out() )
    print(better_view)
    
    return tfidf_vector

def calculateCosineSimilarity(x_vector,y_vector):
    similarity = cosine_similarity(x_vector,y_vector)

    np_smilarity = np.array(similarity)

    eachRowSimilarity = np.sum(np_smilarity,axis=1)
    print(eachRowSimilarity)

    return eachRowSimilarity


@app.route('/show/similar',methods=["GET"])
def similar():
    user_id = request.args.get('user_id')
    if not user_id:
        return "Please provide user_id"
    
    
    vectorizer = getVectorizer()
    
    booksX = getAllBooksX(user_id)
    userDataY = getUsersPreferenceY(user_id)
    if(  len(userDataY)==0 ):
        ids = []
        for i in range( len(booksX)  ):
            ids.append(  booksX[i][3]   )
        return jsonify(ids)

    x_vector = calculateXVectors(vectorizer,booksX)
    y_vector = calcuateYVectors(vectorizer,userDataY)

    similarities = calculateCosineSimilarity(x_vector,y_vector)

        
    rowSimilarityWithBook = list( zip(booksX,similarities) )

    sortedSimilairtyWithBook = sorted(rowSimilarityWithBook,key=lambda x: x[1],reverse=True)

    sorted_books, sorted_scores = zip(*sortedSimilairtyWithBook)

    ids = []
    for i in range(len(sorted_books)):
        ids.append(  sorted_books[i][3] )

    
    return jsonify( ids   )


app.run(port=3000)


import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity






vectorizer = TfidfVectorizer(stop_words='english')
# vectorizer = TfidfVectorizer()


def calculateNewProfile(booksData,weight):

    df = pd.DataFrame(booksData)

    # df['text'] = df['title'] + ' ' + df['description']

    # df['weight'] = df['type'].map(weight)

    # print(df['weight'])

    tfidf_vector =  vectorizer.transform(df['data'])

    # weightted_tfidf =  tfidf_data.multiply(df['weight'].values[:,None])
    # print(weightted_tfidf)

    good_view = pd.DataFrame(tfidf_vector.toarray(),columns=vectorizer.get_feature_names_out())
    print(good_view)
    return tfidf_vector
    # user_profile_vector = np.mean(weightted_tfidf,axis=0)

    # print(user_profile_vector)

    # user_profile_array = np.asarray(user_profile_vector)

    return weightted_tfidf


# X is the no. of documents from which to recommend the user
# Y is the no. of documetns which user has liked/interacted user profile
# Z = X - Y

def calculateProfile(books,weight):


    df = pd.DataFrame(books)


    df['text'] = df['location'] + ' ' + df['description'] + ' ' + df['name'] + ' ' + df['genre']

    # df['weight'] = df['type'].map(weight)

    # print(df['weight'])

    tfidf_vector =  vectorizer.fit_transform(df['text'])
    # weightted_tfidf =  tfidf_data.multiply(df['weight'].values[:,None])

    better_view = pd.DataFrame(tfidf_vector.toarray(),columns=vectorizer.get_feature_names_out() )
    print(better_view)
    
    return tfidf_vector



    # user_profile_vector = np.mean(weightted_tfidf,axis=0)

    # # print(user_profile_vector)

    # user_profile_array = np.asarray(user_profile_vector)

    # return weightted_tfidf

type_weights = {
    'location':1,
    'genre':2,
    'name':3,
    'description':4,
}


booksfromWhichToRecommend = [
    {'location':'butwal','name':"rich dad poor dad",'genre':"finance", 'description':'This is happy book'},
    {'location':'butwal','name':"Advanced java",'genre':"unibook", 'description':'This is java book for coding'},
    {'location':'chitwan','name':"C programming",'genre':"unibook", 'description':'This is book for learning coding'},   
    {'location':'kathmandu','name':"dot net",'genre':"unibook", 'description':'This is happy book'},   
]

userBooksInteracted = [
  {'data':"chitwan"},
  {'data':"butwal Advance java unibook this is java book for coding"}
]

x_vector = calculateProfile(booksfromWhichToRecommend,type_weights)

print("*********************")
y_vector = calculateNewProfile(userBooksInteracted,type_weights)



similarity = cosine_similarity(x_vector,y_vector)
print(similarity)
print("*********************")

np_smilarity = np.array(similarity)

eachRowSimilarity = np.sum(np_smilarity,axis=1)
print(eachRowSimilarity)


rowSimilarityWithBook = list( zip(booksfromWhichToRecommend,eachRowSimilarity) )

sortedSimilairtyWithBook = sorted(rowSimilarityWithBook,key=lambda x: x[1],reverse=True)

sorted_books, sorted_scores = zip(*sortedSimilairtyWithBook)


pandaSorted = pd.DataFrame(sorted_books)
print(pandaSorted)





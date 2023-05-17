import pandas as pd
import numpy as np
import Recommenders as Recommenders
import sys

user=int(sys.argv[1])
mood1=sys.argv[2]
mood2=sys.argv[3]
curgenre=sys.argv[4]

mood = []
mood.append(mood1)
mood.append(mood2)
mood.append(curgenre)

song_df_1 = pd.read_csv('users_songs.csv')
song_df_2 = pd.read_csv('encoded-ex.csv')
song_df = pd.merge(song_df_1, song_df_2.drop_duplicates(['song_id']), on='song_id', how='left')
song_df['song'] = song_df['title']+' - '+song_df['artist_name']
song_df = song_df.head(10000)

ir = Recommenders.item_similarity_recommender_py()
ir.create(song_df, 'user_id', 'song_id')

index = song_df[song_df['user_id'] == user].index[0]
rec=ir.recommend(song_df['user_id'][index])

df_merged = pd.merge(rec, song_df_2, left_on='song', right_on='song_id')
df_merged.drop(['song_id','user_id','release','artist_name'], axis=1, inplace=True)

selected_rows = df_merged[df_merged['Genre'].isin(mood)]
not_selected_rows = df_merged[~df_merged['Genre'].isin(mood)]

result = pd.concat([selected_rows, not_selected_rows])

print(result['song'].to_string(index=False))

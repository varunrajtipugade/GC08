import pandas as pd
import numpy as np
import sys

song_df_1 = pd.read_csv('users_songs.csv')
song_df_2 = pd.read_csv('encoded-ex.csv')
song_df = pd.merge(song_df_1, song_df_2.drop_duplicates(['song_id']), on='song_id', how='left')
song_df['song'] = song_df['title']+' - '+song_df['artist_name']
song_df = song_df.head(10000)
song_grouped = song_df.groupby(['song_id','song','Genre']).agg({'listen_count':'count'}).reset_index()

grouped_sum = song_grouped['listen_count'].sum()
song_grouped['percentage'] = (song_grouped['listen_count'] / grouped_sum ) * 100
allpop=song_grouped.sort_values(['listen_count','song'], ascending=[0,1])
allpop=allpop.head(20)
print(allpop['song_id'].to_string(index=False))

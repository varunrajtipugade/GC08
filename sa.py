import pandas as pd
import numpy as np
import sys

from transformers import pipeline
seq=pipeline(task="text-classification", model="nlptown/bert-base-multilingual-uncased-sentiment", device=0, batch_size=4)

def starcal(argument):
    switcher = {
        '1 star': 1,
        '2 stars': 2,
        '3 stars': 3,
        '4 stars': 4,
        '5 stars': 5
    }
    return switcher.get(argument, 0)

def mooddetection(argument):
    switcher = {
        1: ["Sad","RomanticSad"],
        2: ["RomanticSensual","Motivational"],
        3: ["Devotional","Patriotic"],
        4: ["Bollywood","Romantic"],
        5: ["Dance","DanceRomantic"]
    }
    return switcher.get(argument, "nothing")


with open('newfile.txt') as f:
    lines = [line.rstrip() for line in f]

totalstar=0;
for x in lines:
  st=x
  result=seq(st)
  star=result[0]['label']
  totalstar+=starcal(star)

avgstar=round(totalstar/len(lines))
mood=mooddetection(avgstar)

for z in range(len(mood)):
    print(mood[z])

song_df_1 = pd.read_csv('users_songs.csv')
song_df_2 = pd.read_csv('encoded-ex.csv')
song_df = pd.merge(song_df_1, song_df_2.drop_duplicates(['song_id']), on='song_id', how='left')
song_df['song'] = song_df['title']+' - '+song_df['artist_name']
song_df = song_df.head(10000)
song_grouped = song_df.groupby(['song_id','song','Genre']).agg({'listen_count':'count'}).reset_index()

grouped_sum = song_grouped['listen_count'].sum()
song_grouped['percentage'] = (song_grouped['listen_count'] / grouped_sum ) * 100
allpop=song_grouped.sort_values(['listen_count','song'], ascending=[0,1])


rec=allpop[allpop['Genre'].isin(mood)].head(20)
print(rec['song_id'].to_string(index=False))

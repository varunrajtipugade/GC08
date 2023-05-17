import pandas as pd
import numpy as np
import Recommenders as Recommenders
import sys

user=int(sys.argv[1])

df = pd.read_csv('users_songs.csv')
result = df[df["user_id"] == user]
result = result.iloc[::-1]

print(result["song_id"].to_string(index=False))

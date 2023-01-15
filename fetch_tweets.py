# Import the necessary libraries
import os
import glob
import pandas as pd
import matplotlib.pyplot as plt
from datetime import datetime, timedelta


def get_tweets(curr_dir,data_dir):
    """
    Function to get tweets on a company from start_date to end_date.

    Parameters:
    curr_dir (str): The directory in which the python script is present
    data_dir (str): The directory which has stock market data
    """

    # Fetch all file names from the required directory
    files = [file for file in glob.glob(data_dir)]
    # Path to twitter directory
    twitter_dir = f"./Twitter_Data"
    
    # Iterate over the files
    for file_name in files:
        # Reading the csv file
        df = pd.read_csv(file_name)
        # Get the company name
        company_name = file_name.split("\\")[-1]
        company_name = company_name.split(".")[0]
        # Get the start date
        start_date = df["Date"].iloc[0]
        start_date = "-".join(start_date.split(" ")[:3])
        start_date = datetime.strptime(start_date, "%Y-%b-%d").date()
        # Get the end date
        end_date = df["Date"].iloc[-1]
        end_date = "-".join(end_date.split(" ")[:3])
        end_date = str(datetime.strptime(end_date, "%Y-%b-%d").date())
        # Fetch the tweets and store them in a json file
        json = os.system(f"snscrape --jsonl --progress --max-results 20000\
        --since {start_date} twitter-search \"${company_name} until:{end_date}\" >{twitter_dir}/{company_name}.json")
        # Read the json file
        df = pd.read_json(f"{twitter_dir}/{company_name}.json",lines=True)
        # Store the contents of json in a csv file
        df.to_csv(f"{twitter_dir}/{company_name}.csv",index=False)
        # Remove json file
        os.remove(f"{twitter_dir}/{company_name}.json")
        
def scrape_recent_tweets(user_name, company_name, time):
    tweets = pd.DataFrame()
    twitter_dir = f"./Twitter_Data"
    # Get the start date
    start_date = datetime.now() - timedelta(days=1)
    # Fetch the tweets and store them in a json file
    json = os.system(f"snscrape --jsonl --progress --max-results 20000\
        --since {start_date} twitter-search \"${company_name} from:{user_name}\" > ./Recent_{company_name}.json")
    # Read the json file
    df = pd.read_json(f"./Recent_{company_name}.json",lines=True)
    # Store the contents of json in a csv file
    df.to_csv(f"./Recent_{company_name}.csv",index=False)
    # Remove json file
    os.remove(f"./Recent_{company_name}.json")
    
    # Read the dataset
    df = pd.read_csv(f"./Recent_{company_name}.csv")
    # Iterate through the rows in the dataset
    for index, row in df.iterrows():
        # Get the current tweet time in the required date time format
        current_tweet_time = datetime.strptime(row["date"][:-7], "%Y-%m-%d %H:%M:%S")
        # Get the tweets made in the last "time" minutes, where the variable "time" is user input 
        if (datetime.now() - timedelta(minutes=time) < current_tweet_time) and (datetime.now() > current_tweet_time):
            # Add the required rows into the dataframe
            tweets.append(row)
            
    
        
if __name__ == "__main__":
    curr_dir = os.getcwd()
    data_dir = f"./Stock_Data/5min/*.csv"
    get_tweets(curr_dir,data_dir)
#     scrape_recent_tweets("AbyssOfNight210","AAPL",5)
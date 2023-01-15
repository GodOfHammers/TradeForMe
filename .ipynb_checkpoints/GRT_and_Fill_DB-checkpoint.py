# Import the necessary libraries
import os
import sys
import glob
import pandas as pd
from tabulate import tabulate

def main():
#      print (f"<BR> ---------------------- From Python file: {file_name} ---------------------- <BR>")
#     print (f"Step 1: Storing all the tweets by getting them from Twitter DB for the duration: '{from_date}' to '{to_date}' <BR>")
    # Srikanth to implement
    # get_tweets(company_short_name, from_date, to_date)
    # get_tweets("NAV", "2021-01-01", "2021-03-01")

#     print (f"Step 2: Filtering tweets for company: '{company_short_name}' and sector: '{sector}' <BR>")
    # Srikanth to implement

#     print (f"Step 3: Storing the company stock values for each hour by fetching them from stock exchange DB for the duration: '{from_date}' to '{to_date}' <BR>")
    # Srikanth to implement

#     print (f"Step 4: Finding correlation factor of a twitterati's tweets of a day for a company for each day and the stock price variation")
#     print ("i.e., Doing the correlation analysis of data between Step 2 and Step 3 <BR>")
    # Srikanth to implement


#     print (f"Step 5: Filling data in correlation table for different Twitteratis for the company '{company_short_name}' <BR>")
    # Srikanth to implement
    apple_df = pd.read_csv("./Apple_Final_Scores_Traders.csv")
    apple_df = apple_df.sort_values(by="final_score",ascending=False)
    
    return apple_df.iloc[:5]

if __name__ == "__main__":
    top_5_twitteratis = main()
    print(tabulate(top_5_twitteratis, headers = 'keys', tablefmt = 'html'))
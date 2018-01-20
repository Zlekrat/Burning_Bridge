#!/usr/bin/python3


'''
Module: web_scraper.py
Author: Patrik Holop
About: Module provides basic functions for web scrapping (Fake Hacks)
'''

import re
import sys
import requests
import urllib.parse
import newspaper
from bs4 import BeautifulSoup


def parse_regions(links):
    countries = []
    for link in links:
        try:
            countries.append(get_region(link))
        except:
            pass
    from collections import Counter
    return Counter(countries).most_common(10)


def get_region(url):
    content = requests.get(url, stream=True)
    ip_tup = content.raw._connection.sock.getpeername()
    from geolite2 import geolite2
    reader = geolite2.reader()
    return reader.get(ip_tup[0])['country']['names']['en']


#variables wanted to be printed in certain order
authors_p = ''
date_p = ''
keywords_p = ''

#list of sources (key in text: key to find_dict)
source_dict = {
    "http://edition.cnn.com": "cnn"
}

#prefixes for finding articles
find_dict = {
    "cnn": "http://edition.cnn.com/search/?size=10&type=article&q="
}


def extract_title(page_url):
    ''' Extract important text for finding similar articles '''
    page = load_page(page_url)
    return page.title.string


def find_articles(page_url):
    ''' Find common articles based on topic'''
    for source in source_dict:
        if source in page_url:
            prefix = find_dict[source_dict[source]]
    title = extract_title(page_url)

    quote_pg = prefix + urllib.parse.quote(title)
    found_page = load_page(quote_pg)
    print(quote_pg)
    refs = found_page.find_all("h3")
    for ref in refs:
        print(ref)
    titles = []
    return titles


def load_page(page_url):
    ''' Returns soup of given page '''
    content = requests.get(page_url)
    #import unicodedata
    #unicodedata.normalize('NFKD', content).encode('ascii','ignore')
    soup = BeautifulSoup(content.text, 'html.parser', from_encoding="iso-8859-1")
    return soup


def extract_text(soup_obj):
    ''' Extracts text from soup
    Warning: page specific operation!
    '''
    text = soup_obj.find_all(class_='zn-body__paragraph')
    return text


def get_text_list(page_url):
    ''' Loads text from page in form of list '''
    page = load_page(page_url)
    text = extract_text(page)
    return [txt.get_text() for txt in text]


def get_raw_text(page_url):
    ''' Loads text from page in form of string '''
    text_list = get_text_list(page_url)
    return "\n".join(text_list)


def pretty_print(text, line_length=50):
    ''' Pretty printing of list or string, in form of paragraphs '''
    if 'list' in str(type(text)):
        text = "\n".join(text).split(" ")
    elif 'str' in str(type(text)):
        text = text.split(" ")

    line_len = 0
    word_list = []
    for line in text:
        if line_len > line_length:
            word_list.clear()
            line_len = 0
        else:
            word_list.append(line)
            line_len += len(line)


def google_search(expression):
    page = requests.get('{}{}'.format('https://www.google.sk/search?q=', expression))
    soup = BeautifulSoup(page.content, "html.parser",from_encoding="iso-8859-1")
    results = soup.find_all(class_="r")
    ref = re.compile('.*url\?q=(.*?)&amp.*')
    links = []
    for result in results:
        try:
            links.append(ref.findall(str(result))[0])
        except IndexError:
            pass
    return links


def parse_url(page_url, gr=True):
    article = newspaper.Article(page_url)
    article.download()
    article.parse()
    article.nlp()
    global authors_p
    global date_p
    global keywords_p
    authors_p = ", ".join(article.authors)
    date_p = str(article.publish_date)
    keywords_p = article.keywords
    links = google_search(article.title)
    articles = parse_links(links)
    if gr==True:
        return (article, articles, parse_regions(links))
    else:
        return (article, articles)


def parse_text(text):
    ''' Parse text '''
    from data_analysis import extract_keywords
    title = " ".join(extract_keywords(text))
    links = google_search(title)
    articles = parse_links(links)
    return (text, articles)


def parse_links(links):
    ''' Parse other links to count similarity '''
    return [newspaper.Article(link) for link in links]


def save_graph(counts):
    import matplotlib
    matplotlib.use('Agg')
    import matplotlib.pyplot as plt
    states = [state[0] for state in counts]
    count = [state[1] for state in counts]
    plt.pie(count, explode=[0.1 for x in count], labels=states, colors=['red', 'yellow', 'blue', 'green', 'gold', 'orange'],
            autopct='%1.1f%%', shadow=True, startangle=140)
    plt.axis('equal')
    plt.savefig('../uploads/graph.png')
    plt.savefig('graph.png')
    plt.close()


if __name__ == '__main__':
    if len(sys.argv)!=3:
        print('Wrong number of arguments {} (-t file.txt, -s website.html)'.format(len(sys.argv)))
        sys.exit(-1)
    else:
        if sys.argv[1]=='-t':
            from data_analysis import truth_logic, extract_keywords
            with open(sys.argv[2],'r') as file:
                text = file.read()
            text, articles = parse_text(text)
            result = truth_logic(text, articles, website=False)
            print(result)
            print(", ".join(extract_keywords(text)))

        elif sys.argv[1]=='-s':
            if '.sk' in sys.argv[2] or '.cz' in sys.argv[2]:
                article, articles = parse_url(sys.argv[2], gr=False)
                from data_analysis import truth_logic
                result = truth_logic(article, articles)
                print(result)
            else:
                article, articles, global_ranks = parse_url(sys.argv[2], gr=True)
                from data_analysis import truth_logic
                result = truth_logic(article, articles)
                print(result)
                print(", ".join(article.authors))
                print(date_p)
                print(", ".join(keywords_p))
                save_graph(global_ranks)
        else:
            print('Wrong arguments (-t file.txt, -s website.html)')



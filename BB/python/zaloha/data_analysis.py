#!/usr/bin/python3

'''
Module: data_analysis.py
Author: Patrik Holop
About: Module provides function for comparing articles (Fake Hacks)
'''


import newspaper

def calculate_difference(article1, article2, website=True):
    ''' Calculates difference between refered article and other '''
    if website:
        try:
            article1.download()
            article2.download()
            article1.parse()
            article2.parse()
            article1.nlp()
            article2.nlp()
        except newspaper.article.ArticleException:
            return None

        count = 0
        for key in article1.keywords:
            if key in article2.keywords:
                count += 1
        if len(article1.keywords)==0:
            return 0
        else:
            return count/len(article1.keywords)

    else:
        article1keywords = extract_keywords(article1)
        try:
            article2.download()
            article2.parse()
            article2.nlp()
        except newspaper.article.ArticleException:
            return None

        count = 0
        for key in article1keywords:
            if key in article2.keywords:
                #print(key)
                count += 1
        if len(article1keywords)==0:
            return 0
        else:
            return count/len(article1keywords)


def calculate_all_differences(article, articles, website=True):
    ''' Calculates global error '''
    errors = []
    for article2 in articles:
        err = calculate_difference(article, article2, website)
        if err:
            errors.append(err)
    return errors


def truth_logic(article, articles, website=True):
    ''' Calculates whether article is true or false '''
    errors = calculate_all_differences(article, articles[1:], website)
    #print('Initial truth vector:', errors)
    abs_errors = [0 if error<0.5 else 1 for error in errors]
    #print('Absolut truth vector:', abs_errors)
    if len(abs_errors)==0:
        print(0)
    else:
        print(int(abs_errors.count(1) / len(abs_errors) * 100))
    if len(errors)==0:
        avg_truth = 0
    else:
        avg_truth = sum(errors)/len(errors)
    return (False, avg_truth) if abs_errors.count(0) > abs_errors.count(1) else (True, avg_truth)


def extract_keywords(text):
    ''' Extracts keywords from text '''
    article = newspaper.Article("http://google.com")
    article.download()
    article.set_text(text)
    article.parse()
    article.nlp()
    keywords = article.keywords
    keywords.remove("google")
    return keywords


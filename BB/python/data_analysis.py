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
            article2.download()
            article2.parse()
            article2.nlp()
        except newspaper.article.ArticleException:
            return None

        count = 0
        if 'not' in article1.keywords and not 'not' in article2.keywords:
            return 0
        for key in article1.keywords:
            if key in article2.keywords:
                count += 1
        if len(article1.keywords)==0:
            return 0
        else:
            return count/len(article1.keywords)

    else:
        try:
            article2.download()
            article2.parse()
            article2.nlp()
        except newspaper.article.ArticleException:
            return None

        count = 0
        if 'not' in article1 and not 'not' in article2.keywords:
            return 0
        for key in article1:
            if key in article2.keywords:
                count += 1
        if len(article1)==0:
            return 0
        else:
            return count/len(article1)


def calculate_all_differences(article, articles, website=True):
    ''' Calculates global error '''
    errors = []
    if website:
        try:
            article.download()
            article.parse()
            article.nlp()
        except newspaper.article.ArticleException:
            return None
    else:
        article_keywords = extract_keywords(article)

    for article2 in articles:
        if website:
            err = calculate_difference(article, article2, website)
        else:
            err = calculate_difference(article_keywords, article2, website)
        if err:
            errors.append(err)
    return errors


def truth_logic(article, articles, website=True):
    ''' Calculates whether article is true or false '''
    errors = calculate_all_differences(article, articles[1:], website)
    abs_errors = [0 if error<0.5 else 1 for error in errors]
    if len(abs_errors)==0:
        return 0
    else:
        return int(abs_errors.count(1) / len(abs_errors) * 100)


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


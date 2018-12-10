import nltk
import os
from nltk.tokenize import *
from nltk.corpus import wordnet as wn
from nltk.corpus import stopwords
from nltk.stem import WordNetLemmatizer
from nltk.stem.porter import *


def get_QA_list(file_path):
    with open(file_path, "r", encoding='utf-8', errors='ignore') as f:
        text = f.read().split('\n\n')
    question_list = text[::2]
    answer_list = text[1::2]
    return question_list, answer_list


def combine_lists_to_dict(tuple1, list2):
    combined_dict = dict(zip(tuple1, list2))
    return combined_dict


def combine_list_to_list(list1,list2):
    combined_list = list(zip(list1, list2))
    return combined_list


# combine a dict's list of key and list of value into one list of list
def combine_dict_to_list(dict):
    # combined bag of QA as word
    combined_pair = []
    # combined list of QA as word
    combined_list = []
    for pair in dict:
        for lists in pair:
            combined_list = combined_list + list(lists)
        combined_pair.append(combined_list)
        combined_list = []
    return combined_pair

def tokenize_into_word(list):
    list_of_words = []
    for element in list:
        tokenized_group = nltk.word_tokenize(element)
        list_of_words.append(tokenized_group)
    return list_of_words


#removing stop words and words< 3 letters
def clean_text(tokenized_pair):
    stoplist = set(stopwords.words('english'))
    clean = []
    for word in tokenized_pair:
        if word not in stoplist:
            clean.append(word)
    tokens = []
    for word in clean:
        if word not in tokens:
            if len(word) > 2:
                tokens.append(word)
    return tokens



#lemmatizing stop words list
def lemmatize(clean_list):
    # lower capitalization
    clean_list = [word.lower() for word in clean_list]
    wordnet_lemmatizer = WordNetLemmatizer()
    lemma_list=[]
    for word in clean_list:
        lemma_list.append(wordnet_lemmatizer.lemmatize(word))
    return lemma_list


#Stemming the lemmatized list
def stemming(lemma_list):
    stemmer = PorterStemmer()
    stemmed_tokens = [stemmer.stem(word) for word in lemma_list]
    return stemmed_tokens


#POS tagging
def pos_tag(tokenized_pair_list):
    postaggedwords=[]
    for word in tokenized_pair_list:
        pos_tag=nltk.pos_tag(word)
        postaggedwords.append(pos_tag)
    return postaggedwords


#extracting synsets of all the words to get wornet features
def synsets(word):
    list_of_synsets = wn.synsets(word)
    #print (list_of_synsets)
    return list_of_synsets

def get_hypernyms(words):
    list_of_hypernyms = []
    for word in words:
        word_synsets = synsets(word)
        for synset in word_synsets:
            for hypernym in synset.hypernyms():
                for lemma in hypernym.lemmas():
                    if lemma.name() not in list_of_hypernyms:
                        list_of_hypernyms.append(lemma.name())
    return list_of_hypernyms


#extracting hyponyms
def get_hyponyms(words):
    list_of_hyponyms = []
    for word in words:
        word_synsets = synsets(word)
        for synset in word_synsets:
            for hyponyms in synset.hyponyms():
                for lemma in hyponyms.lemmas():
                    if lemma.name() not in list_of_hyponyms:
                        list_of_hyponyms.append(lemma.name())
    return list_of_hyponyms

#extracting meronyms
def get_meronyms(words):
    list_of_meronyms = []
    for word in words:
        word_synsets = synsets(word)
        for synset in word_synsets:
            for meronyms in synset.part_meronyms():
                for lemma in meronyms.lemmas():
                    if lemma.name() not in list_of_meronyms:
                        list_of_meronyms.append(lemma.name())
    return list_of_meronyms

def merge_all_likely(hyp_list, hyponyms_list, meronyms_list):
    i = len(hyp_list)
    merge_all_likely_list = []
    for num in range(0, i):
        merge_like_list = []
        # print(hyp_list[num])
        merge_like_list.extend(hyp_list[num])
        merge_like_list.extend(hyponyms_list[num])
        # print(hyponyms_list[num])
        merge_like_list.extend(meronyms_list[num])
        merge_all_likely_list.append(merge_like_list)
        # print(merge_like_list)
    # print(merge_all_likely_list)
    return merge_all_likely_list



def matching(question_words, user_words):
    # statitically matching
    max_num = 0
    max_index = 0
    match_num = 0
    matched_num_dict = {}
    i = 1

    for each_question in question_words:
        for word_input in user_words:
            for each in word_input:
                # print(each)
                # print(each in each_question)
                if each in each_question:
                    # print(match_num)
                    match_num = match_num+1
        matched_num_dict[i] = match_num
        if match_num > max_num:
            max_num = match_num
            max_index = i
        match_num = 0
        i = i + 1

    matched_words_dict = {}
    matched_words_list = []
    j = 1
    for each_question in question_words:
        for word_input in user_words:
            for each in word_input:
                if each in each_question:
                    matched_words_list.append(each)
        # print(matched_words_list)
        matched_words_dict[j] = matched_words_list
        matched_words_list = []
        j = j + 1

    return max_index, matched_num_dict, matched_words_dict

def like_match(question_words, user_words, merge_list, stem_input):
    index, matched_num_dict, matched_words_dict = matching(question_words, user_words)
    j = 1
    for each_merge in merge_list:
        num = matched_num_dict[j]
        for each_input in stem_input:
            if each_input in each_merge:
                num = num + 0.8
        matched_num_dict[j] = num
        j = j+1
    return matched_num_dict

def ent(user_input):
    question_list, answer_list = get_QA_list("new.txt")

    question_list_tuple = tuple(question_list)
    bag_of_QA = combine_lists_to_dict(question_list_tuple, answer_list)

    question_tokenized = tokenize_into_word(bag_of_QA)

    values_bag = bag_of_QA.values()
    answers_tokenized = tokenize_into_word(values_bag)

    tokenized_pairs = combine_list_to_list(question_tokenized, answers_tokenized)
    # print(tokenized_pairs)

    combined_pair = combine_dict_to_list(tokenized_pairs)
    # print(combined_pair)

    # user_input = 'ingredients in this product'
    user_words = nltk.word_tokenize(user_input)

    clean_list = []
    for clist in combined_pair:
        newlist = clean_text(clist)
        clean_list.append(newlist)

    clean_input = []
    clean_input = clean_text(user_words)

    lemmatized_list = []
    for llist in clean_list:
        newlist = lemmatize(llist)
        lemmatized_list.append(newlist)
    # print(lemmatized_list)

    lemmatized_input = lemmatize(clean_input)
    # print(lemmatized_input)

    stem_list = []
    for clist in clean_list:
        newlist = stemming(clist)
        stem_list.append(newlist)
    # print(stem_list)

    stem_input = stemming(lemmatized_input)
    # print(stem_input)

    input_stem_word = []
    each_word = []
    for word in stem_input:
        each_word.append(word)
    input_stem_word.append(each_word)
    # print(input_stem_word)

    hyp_list = []
    for sent in lemmatized_list:
        hyp_list.append(get_hypernyms(sent))

    pos_tagged_list = pos_tag(stem_list)
    # print(pos_tagged_list)

    pos_input = pos_tag(input_stem_word)
    # print(pos_input)

    hyp_list = []
    for sent in lemmatized_list:
        hyp_list.append(get_hypernyms(sent))
    # print(hyp_list)

    hyponyms_list = []
    for sent in lemmatized_list:
        hyponyms_list.append(get_hyponyms(sent))
    # print(hyponyms_list)

    meronyms_list = []
    for sent in lemmatized_list:
        meronyms_list.append(get_meronyms(sent))
    # print(meronyms_list)

    merge_list = merge_all_likely(hyp_list, hyponyms_list, meronyms_list)

    index, matched_num_dict, matched_words_dict = matching(pos_tagged_list, pos_input)

    num_dict = like_match(pos_tagged_list, pos_input, merge_list, stem_input)

    # print("matched words of each defined Q&A")

    # print(num_dict)
    index = max(num_dict, key=num_dict.get)

    # print(answer_list[index - 1])
    return answer_list[index - 1]


if __name__ == '__main__':
    ent(input)
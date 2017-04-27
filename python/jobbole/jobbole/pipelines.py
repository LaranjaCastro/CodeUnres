# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

from pymongo import *
from scrapy.conf import settings

class MongoDBPipeline(object):
    _mongo_conn = dict()
    _mongod = ''

    def __init__(self):
        self._mongo_conn['server'] = settings['MONGODB_SERVER']
        self._mongo_conn['port'] = settings['MONGODB_PORT']
        self._mongo_conn['db'] = settings['MONGODB_DB']
        self._mongo_conn['coll'] = settings['MONGODB_COLLECTION']
        self._mongod = self.connection()

    #连接数据库
    def connection(self):
        connection = MongoClient(
            self._mongo_conn['server'],
            self._mongo_conn['port'],
        )
        db = connection[self._mongo_conn['db']]
        coll = db[self._mongo_conn['coll']]
        return coll

    def process_item(self, item, spider):
        if item['content']:
            self._mongod.insert(dict(item))
        return item

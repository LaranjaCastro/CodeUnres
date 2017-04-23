# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

import pymysql
import sys
from scrapy.conf import settings

class SomePipeline(object):
    conn = pymysql.connect(
        settings['MYSQL_HOST'],
        settings['MYSQL_USER'],
        settings['MYSQL_PASSWD'],
        settings['MYSQL_DBNAME'],
        charset='utf8mb4',
    )

    def process_item(self, item, spider):
        cursor = self.conn.cursor()
        sql = "insert into weibo(user_id, title, content, category, create_time) values(%s, %s, %s, %s, %s)"
        params = (1, item['title'], item['content'], 2, '2017-04-12 15:59:54')
        cursor.execute(sql, params)
        try:
            self.conn.commit()
            # cursor.connection.commit()
        except:
            print('\r\n\r\n\r\n\r\n\r\n\r\n\r\n 处理失败 \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n')
            self.conn.rollback()

        return item

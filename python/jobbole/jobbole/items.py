# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

from scrapy import Field, Item


class JobboleItem(Item):
    title = Field()
    url = Field()
    content = Field()
    pass

# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

from scrapy import Item, Field

class SegmentfaultItem(Item):
    title = Field()
    url = Field()
    content = Field()
    # define the fields for your item here like:
    # name = scrapy.Field()
    pass

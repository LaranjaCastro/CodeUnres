from scrapy import Spider
from scrapy.selector import Selector
from sok.items import SokItem


class DoMainsaa(Spider):
    name = 'leon'
    start_urls = ['http://python.jobbole.com/category/guide/']

    def parse(self, reponse):
        sel = Selector(reponse).xpath('//*[@id="archive"]/div/div[2]/p')
        for titles in sel:
            item = SokItem()
            item['title'] = titles.xpath('a/text()').extract()
            yield item
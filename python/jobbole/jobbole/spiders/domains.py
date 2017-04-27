from scrapy import Spider
from scrapy.selector import Selector
from scrapy.http import Request
from jobbole.items import JobboleItem


class Spider(Spider):
    name = 'mioc'
    # allowed_domains = ['http://python.jobbole.com']
    start_urls = ['http://python.jobbole.com/category/guide/page/1/']

    def parse(self, response):
        sel = Selector(response).xpath('//div[@class="post floated-thumb"]')
        for content in sel:
            item = JobboleItem()
            item['title'] = content.xpath('div[2]/p[1]/a[1]/text()').extract_first()
            item['url'] = content.xpath('div[2]/p[1]/a[1]/@href').extract_first()
            if item['url']:
                yield Request(item['url'], callback=self.get_content, meta={'item':item})
                yield item

    def get_content(self, response):
        item = response.meta['item']
        item['content'] = Selector(response).xpath('//div[@class="entry"]').extract_first()
        return item
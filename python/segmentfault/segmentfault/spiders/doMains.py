import scrapy
import sys
from scrapy import Spider
from scrapy.http import Request
from scrapy.selector import Selector
from segmentfault.items import SegmentfaultItem


class Spider(Spider):
    name = 'leon'
    domain = 'https://segmentfault.com'
    start_urls = ['https://segmentfault.com/t/python/blogs?page=1']

    def parse(self, reponse):
        sel  = Selector(reponse).xpath('//section[@class="stream-list__item"]/div[2]')
        for content in sel:
            item = SegmentfaultItem()
            item['title'] = content.xpath('h2/a/text()').extract_first()
            item['url'] = self.domain + content.xpath('h2/a/@href').extract_first()
            if item['url']:
                yield Request(item['url'], callback=self.get_content, meta = {'item':item})

            next_url = Selector(reponse).xpath('//li[@class="next"]/a/@href').extract_first()
            news_url = self.domain + str(next_url)
            if next_url is None:
                print('\r\n\r\n 任务结束 \r\n\r\n')
                sys.exit(0)

            yield item
            yield Request(news_url, callback = self.parse)

    #获取文章内容
    def get_content(self, reponse):
        item = reponse.meta['item']
        item['content'] = Selector(reponse).xpath('//div[@class="article fmt article__content"]').extract_first()
        return item


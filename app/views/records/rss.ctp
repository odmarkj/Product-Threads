<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
    <title><?=$record['Record']['name']?> Threads</title>
    <link>http://www.productthreads.com/records/view/<?=$record['Record']['id']?></link>
    <description><?=$record['Record']['name']?></description>
    <language>en-us</language>
    <pubDate><?php echo date("D, j M Y H:i:s", gmmktime()) . ' GMT';?></pubDate>
    <docs>http://www.productthreads.com/about</docs>
    <generator>Product Threads</generator>
    <managingEditor>info@threads.com</managingEditor>
    <webMaster>webmaster@threads.com</webMaster>
    <?php foreach ($topics as $topic): ?>
    <item>
      <title><?php echo htmlspecialchars($topic['Topic']['title']); ?></title>
      <link>http://www.productthreads.com/topics/view/<?php echo $topic['Topic']['id']; ?></link>
      <description><?php echo htmlspecialchars($topic['Topic']['body']); ?></description>
      <pubDate><?php echo $time->nice($time->gmt($topic['Topic']['created'])) . ' GMT'; ?></pubDate>
      <guid>http://www.productthreads.com/topics/view/<?php echo $topic['Topic']['id']; ?></guid>
    </item>
    <?php endforeach; ?>
  </channel>
</rss>
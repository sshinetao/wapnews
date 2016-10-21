/*
Navicat MySQL Data Transfer

Source Server         : 8080
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : wapnews

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-03-29 11:51:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wap_admin
-- ----------------------------
DROP TABLE IF EXISTS `wap_admin`;
CREATE TABLE `wap_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_login_name` varchar(50) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  `admin_last_time` datetime DEFAULT NULL,
  `admin_iscanuse` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='wap_admin   管理员表';

-- ----------------------------
-- Records of wap_admin
-- ----------------------------
INSERT INTO `wap_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2016-03-18 15:39:37', '1');

-- ----------------------------
-- Table structure for wap_message
-- ----------------------------
DROP TABLE IF EXISTS `wap_message`;
CREATE TABLE `wap_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息id',
  `message_from_id` int(11) NOT NULL COMMENT '消息发送人id',
  `message_news_id` int(11) NOT NULL COMMENT '新闻id',
  `message_to_id` int(11) DEFAULT NULL COMMENT '消息接收人id',
  `message_time` datetime DEFAULT NULL COMMENT '消息发送时间',
  `message_isread` tinyint(1) unsigned DEFAULT '0' COMMENT '是否已读，默认0',
  `message_content` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='消息表';

-- ----------------------------
-- Records of wap_message
-- ----------------------------
INSERT INTO `wap_message` VALUES ('1', '2', '0', '1', '2016-03-09 21:21:27', '0', null);
INSERT INTO `wap_message` VALUES ('2', '2', '0', '1', '2016-03-09 22:02:29', '1', null);
INSERT INTO `wap_message` VALUES ('3', '1', '2', '1', '2016-03-10 20:34:26', '0', 'aaaaa');
INSERT INTO `wap_message` VALUES ('4', '1', '3', '1', '2016-03-10 21:14:47', '0', '噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢');
INSERT INTO `wap_message` VALUES ('5', '2', '2', '1', '2016-03-10 22:09:05', '0', '不错啊');

-- ----------------------------
-- Table structure for wap_news_category
-- ----------------------------
DROP TABLE IF EXISTS `wap_news_category`;
CREATE TABLE `wap_news_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻分类id',
  `category_name` varchar(50) DEFAULT NULL COMMENT '新闻分类名称',
  `category_parent_id` int(11) DEFAULT NULL COMMENT '上级分类id',
  `category_manage_id` int(11) DEFAULT NULL COMMENT '分类编辑id',
  `category_porder` int(10) unsigned DEFAULT NULL COMMENT '排序',
  `category_iscanuse` tinyint(4) DEFAULT '1' COMMENT '分类是否可用',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='新闻分类';

-- ----------------------------
-- Records of wap_news_category
-- ----------------------------
INSERT INTO `wap_news_category` VALUES ('4', '娱乐', '0', null, '1', '1');
INSERT INTO `wap_news_category` VALUES ('5', '体育', '0', null, '2', '1');
INSERT INTO `wap_news_category` VALUES ('6', '政治', '0', null, '3', '1');
INSERT INTO `wap_news_category` VALUES ('7', 'CBA', '5', null, '2', '1');
INSERT INTO `wap_news_category` VALUES ('8', 'NBA', '5', null, '1', '1');
INSERT INTO `wap_news_category` VALUES ('10', '中国足球', '5', null, '3', '1');
INSERT INTO `wap_news_category` VALUES ('14', 'ncaa', '5', null, '1', '1');
INSERT INTO `wap_news_category` VALUES ('17', '中国', '6', null, '1', '1');
INSERT INTO `wap_news_category` VALUES ('18', '美国', '6', null, '2', '1');
INSERT INTO `wap_news_category` VALUES ('19', '日本', '6', null, '3', '1');
INSERT INTO `wap_news_category` VALUES ('20', '韩国', '4', null, '2', '1');
INSERT INTO `wap_news_category` VALUES ('21', '大陆', '4', null, '1', '1');
INSERT INTO `wap_news_category` VALUES ('22', '港台', '4', null, '2', '1');

-- ----------------------------
-- Table structure for wap_news_comment
-- ----------------------------
DROP TABLE IF EXISTS `wap_news_comment`;
CREATE TABLE `wap_news_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `comment_user_id` int(11) NOT NULL COMMENT '评论用户id',
  `comment_content_id` int(10) unsigned DEFAULT NULL COMMENT '被评论文章id',
  `comment_content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `comment_parent_id` int(11) unsigned DEFAULT '0' COMMENT '上级评论',
  `comment_time` datetime DEFAULT NULL,
  `comment_iscanuse` tinyint(4) DEFAULT '1' COMMENT '评论是否可用',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='评论列表';

-- ----------------------------
-- Records of wap_news_comment
-- ----------------------------
INSERT INTO `wap_news_comment` VALUES ('1', '1', '3', '哈哈哈哈哈哈哈', '0', '2016-03-08 14:32:34', '1');
INSERT INTO `wap_news_comment` VALUES ('2', '1', '3', 'enenennenee', '1', '2016-03-16 14:57:50', '1');
INSERT INTO `wap_news_comment` VALUES ('5', '1', '2', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '0', '2016-03-09 06:33:43', '1');
INSERT INTO `wap_news_comment` VALUES ('10', '1', '2', '复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴', '0', '2016-03-09 08:13:11', '1');
INSERT INTO `wap_news_comment` VALUES ('11', '1', '2', '复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴', '0', '2016-03-09 08:13:46', '1');
INSERT INTO `wap_news_comment` VALUES ('12', '1', '2', '复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴', '0', '2016-03-09 08:14:11', '1');
INSERT INTO `wap_news_comment` VALUES ('13', '1', '2', '复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴', '0', '2016-03-09 08:14:40', '1');
INSERT INTO `wap_news_comment` VALUES ('14', '1', '2', '复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴', '0', '2016-03-09 08:14:50', '1');
INSERT INTO `wap_news_comment` VALUES ('15', '1', '2', '复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴答滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴滴点点滴复否i上的点点滴滴点点滴滴答滴答滴答滴答滴答滴答滴答滴', '0', '2016-03-09 16:17:26', '1');
INSERT INTO `wap_news_comment` VALUES ('16', '1', '2', '啊上的点点滴滴答', '6', '2016-03-09 16:46:08', '1');
INSERT INTO `wap_news_comment` VALUES ('17', '1', '2', '啊啊啊啊啊', '16', '2016-03-09 16:46:39', '1');
INSERT INTO `wap_news_comment` VALUES ('18', '1', '2', 'aaaa', '10', '2016-03-10 20:33:30', '1');
INSERT INTO `wap_news_comment` VALUES ('19', '1', '2', 'aaaaa', '10', '2016-03-10 20:34:00', '1');
INSERT INTO `wap_news_comment` VALUES ('20', '1', '2', 'aaaaa', '10', '2016-03-10 20:34:12', '1');
INSERT INTO `wap_news_comment` VALUES ('21', '1', '2', 'aaaaa', '10', '2016-03-10 20:34:26', '1');
INSERT INTO `wap_news_comment` VALUES ('22', '1', '3', '噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢噢', '2', '2016-03-10 21:14:47', '1');
INSERT INTO `wap_news_comment` VALUES ('24', '1', '2', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0028.gif\"/></p>', '0', '2016-03-11 22:23:23', '1');
INSERT INTO `wap_news_comment` VALUES ('26', '1', '3', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0002.gif\"/></p>', '0', '2016-03-11 22:36:15', '1');
INSERT INTO `wap_news_comment` VALUES ('27', '1', '3', '<p><img src=\"http://img.baidu.com/hi/jx2/j_0002.gif\"/></p>', '0', '2016-03-11 22:38:29', '1');
INSERT INTO `wap_news_comment` VALUES ('28', '1', '3', '<p><img src=\"http://localhost/wapnews/public/ueditor/dialogs/emotion/images/jx2/j_0002.gif\"/></p>', '0', '2016-03-11 22:39:26', '1');
INSERT INTO `wap_news_comment` VALUES ('29', '1', '3', '<p><img src=\"http://localhost/wapnews/public/ueditor/dialogs/emotion/images/youa/y_0017.gif\"/></p>', '0', '2016-03-11 22:39:51', '1');

-- ----------------------------
-- Table structure for wap_news_content
-- ----------------------------
DROP TABLE IF EXISTS `wap_news_content`;
CREATE TABLE `wap_news_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻编号',
  `content_title` varchar(50) NOT NULL COMMENT '新闻标题',
  `content_content` varchar(1000) NOT NULL COMMENT '新闻内容',
  `content_category_id` int(10) unsigned NOT NULL COMMENT '属于哪个分类',
  `content_author_id` int(11) NOT NULL COMMENT '新闻作者id',
  `content_post_time` datetime DEFAULT NULL COMMENT '新闻发布日期',
  `content_last_time` datetime DEFAULT NULL COMMENT '最后回复日期',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- ----------------------------
-- Records of wap_news_content
-- ----------------------------
INSERT INTO `wap_news_content` VALUES ('1', '孟菲斯', '<p><img src=\"/wapnews/public/ueditor/php/upload/image/20160313/1457850259.jpg\" title=\"1457850259.jpg\" alt=\"Lighthouse.jpg\"/>第一个直接插入新闻<img src=\"http://localhost/wapnews/public/ueditor/dialogs/emotion/images/face/i_f29.gif\"/></p>', '8', '1', '2016-03-08 09:51:08', '2016-03-13 14:28:34');
INSERT INTO `wap_news_content` VALUES ('2', '广东宏远', '<p>广东宏远<img src=\"http://localhost/wapnews/public/ueditor/dialogs/emotion/images/jx2/j_0025.gif\"/></p>', '7', '1', '2016-03-01 13:59:03', '2016-03-13 14:20:26');
INSERT INTO `wap_news_content` VALUES ('3', '第一个直接插入新闻', '<p>第一个直接插入新闻aaaaaaaaaaaaaaaaaaaaaaaaaa</p>', '8', '2', '2016-03-02 13:59:08', '2016-03-13 14:01:03');
INSERT INTO `wap_news_content` VALUES ('6', '把Baby放哪里！黄晓明连续7年告白赵薇', '<p>艺人黄晓明去年跟Angelababy结婚，对老婆宠上了天。不过，他先前曾大方说赵薇是自己的初恋女神，今天也在微博祝对方40岁生日快乐，两人深厚友谊令人羡慕。</p><p style=\"word-wrap: break-word; margin-top: 10px; margin-bottom: 10px; padding: 0px; list-style: none; text-align: center; overflow: visible !important;\"><a href=\"http://img.qhtv.cn/portal/201603/13/184547mlyyyo94axmpg8ym.jpg\" target=\"_blank\" style=\"word-wrap: break-word; font-family: Arial, Helvetica, 宋体; font-size: 12px; margin: 0px; padding: 0px; color: rgb(57, 57, 57); text-decoration: none;\"><img src=\"http://img.qhtv.cn/portal/201603/13/184547mlyyyo94axmpg8ym.jpg\" style=\"word-wrap: break-word; margin: 0px auto 10px; padding: 0px; border: none; max-width: 600px; height: auto; overflow: hidden;\"/></a></p><p style=\"word-wrap: break-word; margin-top: 10px; margin-bottom: 10px; padding: 0px; list-style: none; text-align: center; overflow: visible !important;\"><br style=\"word-wrap: break-word; font-family: Arial, Helvetica, 宋体; font-size: 12px; margin: 0px; padding: 0px;\"/></p><p style=\"word-wrap: brea', '21', '1', '2016-03-13 19:55:43', null);
INSERT INTO `wap_news_content` VALUES ('7', '京沪主持人复排演出话剧《霓虹灯下的哨兵》', '<p style=\"padding: 0px; margin-top: 0px; margin-bottom: 10px; border: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); line-height: 32px; color: rgb(57, 57, 57); font-family: 宋体; white-space: normal; background-color: rgb(255, 255, 255);\">新华社北京３月１３日专电（记者许晓青）由京沪两地主持人联合排演的新版话剧《霓虹灯下的哨兵》１２日晚在北京解放军歌剧院首演，全剧还原了半个多世纪前《霓虹灯下的哨兵》初创时的诸多场景画面，受到观众好评。</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 10px; border: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); line-height: 32px; color: rgb(57, 57, 57); font-family: 宋体; white-space: normal; background-color: rgb(255, 255, 255);\">　　《霓虹灯下的哨兵》是一部与１９４９年上海解放有着密切关联的著名文艺作品，讲述了解放军进驻上海后，“中华商业第一街”南京路上“好八连”传奇故事。自上世纪６０年代诞生以来，同一主题的话剧、电影、电视剧等深受观众喜爱，是几代中国人一段难忘的“集体记忆”。</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 10px; border: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); line-height: 32px; color: rgb(57, 57, 57); font-family: 宋体; white-space: normal; background-color: rgb(255, 255, 255);\">　　此番京沪主持人联袂演出，由上海广播电视台“公益媒体群”发起，得到了上海广播电视', '21', '1', '2016-03-13 19:56:33', null);
INSERT INTO `wap_news_content` VALUES ('8', '看了这些，你还喜欢Angelababy的绝对是真爱！', '<p style=\"padding: 0px; margin: 0px 3px 15px; font-family: 宋体; font-size: 15px; line-height: 25.5px; white-space: normal; text-indent: 30px; background-color: rgb(255, 255, 255);\">摘要】：Angelababy杨颖。翻厚的嘴唇真的是太明显了，而且鼻子也非常的塌扁。...　　　　　　　</p><p style=\"padding: 0px; margin: 0px 3px 15px; font-family: 宋体; font-size: 15px; line-height: 25.5px; white-space: normal; text-indent: 30px; background-color: rgb(255, 255, 255);\">今天小编又为大家带来什么爆炸性新闻呢？近几年娱乐馆最受关注的几个人，范冰冰和李晨，Angelababy和黄晓明，正可谓是要想成名必须先炒，没错，今天小编要说的就是家喻户晓，人气爆棚的女神Angelababy杨颖。</p><p style=\"text-align:center;padding: 0px; margin-top: 0px; margin-bottom: 0px; font-family: 宋体; font-size: 15px; line-height: 25.5px; white-space: normal; background-color: rgb(255, 255, 255);\"><img alt=\"看了这些 你还喜欢Angelababy的绝对是真爱！\" id=\"1125258702\" md5=\"\" src=\"/wapnews/public/ueditor/php/upload/image/201603131457870226108827.jpg\" style=\"padding: 0px; margin: 0px; border: 0px;\"/></p><p><br/></p>', '21', '1', '2016-03-13 19:57:07', null);
INSERT INTO `wap_news_content` VALUES ('9', ' 中国军费为何放缓?美媒:军事现代化基本实现', '<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; list-style: none; font-size: 14px; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); white-space: normal; overflow: visible !important;\">【环球军事报道】今年<a href=\"http://country.huanqiu.com/china\" class=\"linkAbout\" target=\"_blank\" title=\"中国\" style=\"color: rgb(6, 52, 111); text-decoration: none; border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(6, 52, 111); margin: 0px 5px; padding: 0px 0px 2px;\">中国</a>的军费增长只有7.6%，这是2010年以来首次出现个位数的增长速度。对于解放军军费增长的放缓，<a href=\"http://country.huanqiu.com/america\" class=\"linkAbout\" target=\"_blank\" title=\"美国\" style=\"color: rgb(6, 52, 111); text-decoration: none; border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(6, 52, 111); margin: 0px 5px; padding: 0px 0px 2px;\">美国</a>“国家利益”网站3月7日发表文章称，讨论中国军费增长放缓的原因和影响。</p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; font-size: 14px; line-height: 26px; font-family: SimSun; color:', '17', '1', '2016-03-13 19:58:09', null);
INSERT INTO `wap_news_content` VALUES ('10', '美媒：中国“打骂教育”引争议 棍棒出孝子更出家暴', '<p style=\"margin-top: 0px; margin-bottom: 0px; padding: 0px; list-style: none; font-size: 14px; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); white-space: normal; overflow: visible !important;\"><strong>《纽约时报》3月10日文章，通过家暴棱镜看<a href=\"http://country.huanqiu.com/china\" class=\"linkAbout\" target=\"_blank\" title=\"中国\" style=\"color: rgb(6, 52, 111); text-decoration: none; border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(6, 52, 111); margin: 0px 5px; padding: 0px 0px 2px;\">中国</a>的严厉育儿经&nbsp;</strong>&nbsp;我儿子所在小学的一名中国父亲很热心，他对我建议说，“如果你儿子不听话就扇他耳光。我就是这么做的”，他扬起巴掌作势说。“这不管用”，我说。惊骇之下，我希望基于打人效果——而非道德说教——来说服这位显然相信中国谚语“棍棒底下出孝子”的父亲。“你错了!会管用的”，他轻松地说道，然后把注意力转向更认同该观点的其他家长。</p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; font-size: 14px; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); white-space: normal; overflow: visible !important;\">　　中国1986年就宣布学校体罚学生属违法行为，但此类严厉管教孩子的做法如今依然普遍。这折射出中国的“打骂教育”传统，即便该传统近年已引发争议。</p><p style=\"margin:', '18', '1', '2016-03-13 19:58:40', null);

-- ----------------------------
-- Table structure for wap_news_manage
-- ----------------------------
DROP TABLE IF EXISTS `wap_news_manage`;
CREATE TABLE `wap_news_manage` (
  `manage_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编辑id',
  `manage_login_name` varchar(50) NOT NULL COMMENT '编辑登录名',
  `manage_password` varchar(255) NOT NULL COMMENT '编辑密码',
  `manage_name` varchar(50) NOT NULL COMMENT '编辑别名',
  `manage_touxiang` varchar(255) DEFAULT NULL COMMENT '编辑头像',
  `manage_reg_time` datetime DEFAULT NULL COMMENT '注册日期',
  `manage_last_time` datetime DEFAULT NULL COMMENT '上次登录日期',
  `manage_iscansue` tinyint(4) DEFAULT '1' COMMENT '编辑账号是否启用',
  PRIMARY KEY (`manage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='网站编辑表';

-- ----------------------------
-- Records of wap_news_manage
-- ----------------------------
INSERT INTO `wap_news_manage` VALUES ('1', '00001', '96e79218965eb72c92a549dd5a330112', '999', null, '2016-03-01 13:58:05', '2016-03-13 19:37:42', null);
INSERT INTO `wap_news_manage` VALUES ('2', '00002', '96e79218965eb72c92a549dd5a330112', '恩呢', null, null, null, '1');

-- ----------------------------
-- Table structure for wap_user
-- ----------------------------
DROP TABLE IF EXISTS `wap_user`;
CREATE TABLE `wap_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_login_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_reg_time` datetime DEFAULT NULL,
  `user_last_time` datetime DEFAULT NULL,
  `user_touxiang` varchar(255) DEFAULT '../public/touxiang/0.jpg',
  `user_canuse` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of wap_user
-- ----------------------------
INSERT INTO `wap_user` VALUES ('1', '11113ww', '111111', 'e10adc3949ba59abbe56e057f20f883e', '2016-03-01 13:57:00', '2016-03-13 19:33:06', '../public/touxiang/201603130442315960.jpg', '1');
INSERT INTO `wap_user` VALUES ('2', '123456', '000000', 'e10adc3949ba59abbe56e057f20f883e', '2016-03-14 18:40:19', null, '../public/touxiang/0.jpg', '1');
INSERT INTO `wap_user` VALUES ('3', '666666', '666666', 'f379eaf3c831b04de153469d1bec345e', '2016-03-14 18:46:43', '2016-03-14 18:46:43', '../public/touxiang/0.jpg', '1');
INSERT INTO `wap_user` VALUES ('4', '666666', '666666', 'f379eaf3c831b04de153469d1bec345e', '2016-03-14 18:46:43', '2016-03-14 18:46:43', '../public/touxiang/0.jpg', '1');
INSERT INTO `wap_user` VALUES ('5', '777777', '777777', 'f63f4fbc9f8c85d409f2f59f2b9e12d5', '2016-03-14 18:50:35', '2016-03-14 18:51:46', '../public/touxiang/0.jpg', '1');

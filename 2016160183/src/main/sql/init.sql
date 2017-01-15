CREATE DATABASE IF NOT EXISTS middle_ware DEFAULT charset utf8 COLLATE utf8_general_ci;

drop table if exists survey;
CREATE TABLE survey (
        id int unsigned NOT NULL AUTO_INCREMENT,
        topic varchar(50) NOT NULL COMMENT '投票标题',
        mode int unsigned NOT NULL COMMENT '模式:1单选,0多选',
        create_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
        end_time timestamp COMMENT '截止时间',
        PRIMARY KEY (id)
) default charset utf8 COLLATE utf8_general_ci;

drop table if exists options;
CREATE TABLE options (
        id int unsigned NOT NULL AUTO_INCREMENT,
        topic_id int unsigned NOT NULL COMMENT '投票id',
        content varchar(100) NOT NULL COMMENT '选项内容',
        votes int unsigned NOT NULL DEFAULT 0 COMMENT '投票数',
        PRIMARY KEY (id)
) default charset utf8 COLLATE utf8_general_ci;
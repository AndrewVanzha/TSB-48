CREATE TABLE IF NOT EXISTS inkass_users
(
    id            int(11) NOT NULL AUTO_INCREMENT,
    inkass_id     varchar(60) NOT NULL,
    inkass_fio    varchar(120) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS inkass_orders
(
    id             int(11)      NOT NULL AUTO_INCREMENT,
    user_id        int(11)      NOT NULL,
    date           datetime     NOT NULL,
    check_date     datetime     NOT NULL,
    start_time     datetime     NOT NULL,
    finish_time    datetime     NOT NULL,
    date_expired   datetime,
    fio            varchar(120) NOT NULL,
    office         varchar(255) NOT NULL,
    status_captcha int(1)               DEFAULT 0,
    status         int(1)      NOT NULL DEFAULT 0,
    question_1          varchar(255),
    question_1_ask      varchar(255),
    question_1_comment  varchar(255),
    question_2          varchar(255),
    question_2_ask      varchar(255),
    question_2_comment  varchar(255),
    question_3          varchar(255),
    question_3_ask      varchar(255),
    question_3_comment  varchar(255),
    question_4          varchar(255),
    question_4_ask      varchar(255),
    question_4_comment  varchar(255),
    question_5          varchar(255),
    question_5_ask      varchar(255),
    question_5_comment  varchar(255),
    question_6          varchar(255),
    question_6_ask      varchar(255),
    question_6_comment  varchar(255),
    question_7          varchar(255),
    question_7_ask      varchar(255),
    question_7_comment  varchar(255),
    question_8          varchar(255),
    question_8_ask      varchar(255),
    question_8_comment  varchar(255),
    question_9          varchar(255),
    question_9_ask      varchar(255),
    question_9_comment  varchar(255),
    question_10         varchar(255),
    question_10_ask     varchar(255),
    question_10_comment varchar(255),
    dop_comment         varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS inkass_code
(
    id           int(11)       NOT NULL AUTO_INCREMENT,
    order_id     int(11),
    date         datetime      NOT NULL,
    date_expired datetime      NOT NULL,
    fio          varchar(120)  NOT NULL,
    code         varchar(255)  NOT NULL,
    attempts     int(3)        NOT NULL DEFAULT 0,
    status       int(1)        NOT NULL,
    phone_number varchar(10)   DEFAULT '',
    status_phone int(1)        NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS inkass_event
(
    id       int(11)     NOT NULL AUTO_INCREMENT,
    order_id int(11),
    date     datetime    NOT NULL,
    name     varchar(50) NOT NULL,
    message  text        NOT NULL,
    PRIMARY KEY (id)
);
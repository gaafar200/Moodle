/** My database */
CREATE DATABASE IF NOT EXISTS university_model;
use university_model;
create table if not exists users(
    id int(11) not null auto_increment primary key,
    university_id int(11) unique,
    f_name varchar(30) not null,
    m_name varchar(30) not null,
    l_name varchar(30) not null,
    address varchar(150) not null,
    phone_number int(10) not null,
    username varchar(100) not null unique,
    password varchar(250) not null,
    email varchar(150) not null unique,
    photo varchar(250) not null unique,
    rank varchar(20) not null,
    created_by int(11),
    FOREIGN Key(created_by) references users(id) ON DELETE set null ON UPDATE CASCADE,
    date datetime not null default CURRENT_TIMESTAMP
);

create table if not exists course(
    id int(11) not null auto_increment primary key,
    name varchar(50) not null,
    date datetime not null default CURRENT_TIMESTAMP,
    status varchar(20) not null default "active",
    language varchar(25) not null default "english",
    photo varchar(250) not null unique,
    lecturer_id int(11) references users(id) ON DELETE set null ON UPDATE CASCADE,
    created_by int(11),
    FOREIGN Key(created_by) references users(id) ON DELETE set null ON UPDATE CASCADE
);

create table if not exists assignment(
    id int(11) not null auto_increment primary key,
    max_size_allowed decimal(5,2) not null,
    create_date datetime default CURRENT_TIMESTAMP not null,
    start_date datetime default CURRENT_TIMESTAMP,
    deadline datetime not null,
    status varchar(25) not null,
    last_submition_date datetime not null,
    max_attempts tinyint(3) not null default 1,
    description varchar(255),
    assignment_material varchar(255),
    course_id int(11) not null references course(id) ON DELETE CASCADE ON UPDATE CASCADE,
    mark_value tinyint(3) not null,
    max_number_of_files tinyint(3) not null,
    check(start_date > create_date),
    check(last_submition_date > CURRENT_TIMESTAMP),
    check(deadline > CURRENT_TIMESTAMP)
);

create table if not exists mark_method(
    id int(11) not null primary key,
    name varchar(50) not null unique
);

create table if not exists quiz(
    id int(11) not null auto_increment primary key,
    name varchar(50) not null,
    created_date datetime not null default CURRENT_TIMESTAMP,
    start_date datetime not null,
    desciption varchar(255),
    mark_technique tinyint(3) not null default 0 references mark_method(id) ON DELETE SET null ON UPDATE CASCADE, 
    number_of_questions tinyint(3) not null,
    max_attempts tinyint(3) not null default 1,
    close_date datetime not null,
    time tinyint(3) not null,
    course_id int(11) not null references course(id) ON DELETE CASCADE ON UPDATE CASCADE,
    mark_value tinyint(3) not null,
    status varchar(25) not null,
    is_disclosed tinyint(1) not null default 1,
    is_shuffled tinyint(1) not null default 0,
    i_review_allowed tinyint(1) not null default 0,
    is_recursive tinyint(1) not null default 1,
    number_of_question_in_page tinyint(2) not null default 3,
    is_equal_distributed tinyint(1) not null default 1,
    check (close_date > start_date)
);

create table if not exists question_type(
    id int(11) not null primary key,
    name varchar(25) not null
);
create table if not exists question(
    id int(11) not null auto_increment primary key,
    type tinyint(3) not null references qusetion_type(id),
    question varchar(255) not null,
    max_number_of_files tinyint(3) default 1,
    max_size_allowed decimal(5,2),
    descriptive_photo varchar(255),
    question_material varchar(255),
    mark_value tinyint(3) not null
);
create table if not exists Announcement(
    id int(11) not null auto_increment primary key,
    content varchar(255) not null,
    date datetime default CURRENT_TIMESTAMP,
    course_id int(11) not null references course(id) ON DELETE CASCADE ON UPDATE CASCADE
);
create table if not exists question_choice(
    question_id int(11) not null references question(id),
    choice varchar(250) not null,
    is_right_answer tinyint(1) not null,
    primary key(question_id,choice)
);

create table if not exists lecturer_degree(
    lecturer_id int(11) not null references users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    degree varchar(100) not null,
    primary key(lecturer_id,degree)
);

create table if not exists Assignment_accepted_file_types(
    assignment_id int(11) not null references assignment(id),
    file_type varchar(255) not null,
    primary key(assignment_id,file_type) 
);
create table if not exists question_accepted_file_types(
    question_id int(11) not null references question(id),
    file_type varchar(255) not null,
    primary key(question_id,file_type) 
);

create table if not exists student_courses(
    student_id int(11) not null references user(id),
    course_id int(11) not null references course(id),
    finished tinyint(1) not null default 0,
    primary key(student_id,course_id),
    grade tinyint(3) 
);

create table if not exists quiz_questions(
    question_id int(11) not null references question(id),
    quiz_id int(11) not null references quiz(id),
    primary key(question_id,quiz_id)
);
create table if not exists student_quiz(
    id int(11) not null auto_increment unique,
    student_id int(11) not null references user(id),
    quiz_id int(11) not null references quiz(id),
    grade tinyint(3),
    start_time datetime not null default CURRENT_TIMESTAMP,
    end_time datetime,
    primary key(student_id,quiz_id)
);

create table if not exists student_quiz_question(
    id int(11) not null auto_increment unique,
    question_id int(11) not null references question(id),
    student_quiz int(11) not null references student_quiz(id),
    grade tinyint(3),
    is_flaged tinyint(1) default 0,
    is_solved tinyint(1) default 0
);

create table if not exists student_quiz_question_choices(
    student_quiz_question_id int(11) not null references student_quiz_question(id),
    choice_id int(11) not null references choice(id),
    primary key(student_quiz_question_id,choice_id)  
);

create table if not exists student_quiz_question_files(
    student_quiz_question_id int(11) not null references student_quiz_question(id),
    File varchar(250),
    primary key(student_quiz_question_id,File)
);

create table if not exists student_assignment(
    id int(11) not null auto_increment unique,
    student_id int(11) not null references user(id) ON DELETE CASCADE ON UPDATE CASCADE,
    assignment_id int(11) not null references assignment(id) ON DELETE CASCADE ON UPDATE CASCADE,
    primary key(student_id,assignment_id),
    is_marked tinyint(1) not null default 0,
    mark tinyint(3),
    is_disclosed tinyint(1) not null default 1,
    delivered_time datetime,
    marking_time datetime,
    notes varchar(255)
);

create table if not exists student_assignment_files(
    student_assignment_id int(11) not null references student_assignment(id),
    file varchar(255),
    primary key(student_assignment_id,file)
);

create table if not exists message(
    id int(11) not null auto_increment primary key,
    message_content varchar(255) not null,
    message_from int(11) not null references user(id),
    send_date datetime not null default CURRENT_TIMESTAMP,
    delivered_state tinyint(1) not null default 0,
    message_to varchar(15) not null default "person",
    destination_user int(11) references user(id),
    destination_course_student int(11) references course(id)
);

CREATE TABLE IF NOT EXISTS user_tokens
(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    token            VARCHAR(255) NOT NULL unique,
    expiry           DATETIME NOT NULL,
    user_id          INT      NOT NULL,
    CONSTRAINT fk_user_id
        FOREIGN KEY (user_id)
            REFERENCES users (id) ON DELETE CASCADE
);


INSERT INTO `users` (`id`, `university_id`, `f_name`, `m_name`, `l_name`, `address`, `phone_number`, `username`, `password`, `email`, `photo`, `rank`, `created_by`, `date`) VALUES (NULL, NULL, 'mahmoud', 'mohammed', 'jaafar', 'palestine-gaza', '0598790035', 'admin2000', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@gmail.com', 'C:\\xampp\\htdocs\\model\\data\\users\\admin.jpg', 'admin', NULL, current_timestamp());
alter table user_tokens modify expiry BIGINT not null;
alter table users drop m_name;
alter table users add description varchar(250) after rank;
drop table lecturer_degree;

ALTER TABLE `users` CHANGE `phone_number` `phone_number` VARCHAR(10) NOT NULL;
Alter table users add gender ENUM ("male","female") not null after password;
ALTER Table Course ADD COLUMN description varchar(255) not null;

   





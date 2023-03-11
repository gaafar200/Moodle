<?php $this->view("include/header",["pageName"=>$pageName]); ?>
<?php $this->view("include/sidebar"); ?>
<?php $this->view("include/upbar",["user"=>$user]); ?>
<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul class="collapse dropdown-header-top">
                                    <li><a href="index.html">Dashboard</a></li>
                                </ul>
                            </li>

                            <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="demoevent" class="collapse dropdown-header-top">
                                    <li><a href="all-professors.html">All Professors</a>
                                    </li>
                                    <li><a href="add-professor.html">Add Professor</a>
                                    </li>
                                    <li><a href="edit-professor.html">Edit Professor</a>
                                    </li>
                                    <li><a href="professor-profile.html">Professor Profile</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demopro" href="#">Students <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="demopro" class="collapse dropdown-header-top">
                                    <li><a href="all-students.html">All Students</a>
                                    </li>
                                    <li><a href="add-student.html">Add Student</a>
                                    </li>
                                    <li><a href="edit-student.html">Edit Student</a>
                                    </li>
                                    <li><a href="student-profile.html">Student Profile</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#democrou" href="#">Courses <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="democrou" class="collapse dropdown-header-top">
                                    <li><a href="all-courses.html">All Courses</a>
                                    </li>
                                    <li><a href="add-course.html">Add Course</a>
                                    </li>
                                    <li><a href="edit-course.html">Edit Course</a>
                                    </li>
                                    <li><a href="course-info.html">Courses Info</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="demo" class="collapse dropdown-header-top">
                                    <li><a href="mailbox.html">Inbox</a>
                                    </li>
                                    <li><a href="mailbox-view.html">View Mail</a>
                                    </li>
                                    <li><a href="mailbox-compose.html">Compose Mail</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span
                                        class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="Pagemob" class="collapse dropdown-header-top">
                                    <li><a href="login.html">Login</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list single-page-breadcome" style="margin-top:  10vh;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <form role="search" class="sr-input-func">
                                    <input type="text" placeholder="Search..." class="search-int form-control"
                                        name="search">
                                    <a><button type="submit" class="pro-5"><i class="fa fa-search"></i></button></a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Course Info</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="blog-details-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-details-inner change-background">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="latest-blog-single blog-single-full-view">
                                <div class="questions-page-wrapper">
                                    <div class="course-name-wrapper">
                                        <h4 class="course-name">Digital Electronics</h4>
                                    </div>
                                    <div class="questions-page-container">
                                        <form class="form-questions">
                                            <div class="questions-page-questions">
                                                <?php $count = 1; ?>
                                                <?php foreach ($questions as $question): ?>
                                                    <div class="questions-page-question-wrapper">
                                                        <div class="questions-page-question-details">
                                                            <span class="questions-page-question-details-number">
                                                                Question <span><?= $count++ ?> </span>
                                                            </span>
                                                            <span class="questions-page-question-details-mark">
                                                                <span><?= $question->mark_value ?></span> Mark
                                                            </span>
                                                        </div>
                                                        <div class="questions-page-question-container">
                                                            <?php if($question->photo != ""): ?>
                                                                <img class="questions-page-question-container-img"
                                                                    src="<?= $question->photo ?>" />/
                                                            <?php endif; ?>
                                                            <span class="questions-page-question"><?= $question->question ?></span>
                                                            <?php if($question->type == "essayQuestion"): ?>
                                                                <label for="images" class="drop-container">
                                                                    <span class="drop-title">Drop files here</span>
                                                                    or
                                                                    <input type="file" id="images" accept="*" />
                                                                </label>
                                                            <?php else: ?>
                                                                <span class="questions-page-select">Select one:</span>
                                                                <div class="questions-page-choices">
                                                                    <?php foreach ($question->choices as $choice): ?>
                                                                        <div class="questions-page-choice-one">
                                                                            <input type="radio" id="<?= $choice->name ?>" name="<?= $question->name ?>" />
                                                                            <label for="<?= $choice->name ?>"><?= $choice->choice ?></label>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>


                                                <div class="questions-page-move">
                                                    <button type="button" class="questions-page-move-previous">
                                                        Previous page
                                                    </button>
                                                    <button type="submit" class="questions-page-move-next">
                                                        Next page
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="quiz-navigation">
                                            <span class="quiz-navigation-title"> Quiz navigation </span>
                                            <img
                                                src="<?= $user->photo ?>" />
                                            <span class="quiz-navigation-name"><?= ucfirst($user->f_name) . " "  . ucfirst($user->l_name)?></span>
                                            <div class="quiz-navigation-questions">
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">1</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">2</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">3</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">4</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">5</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">6</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">7</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">8</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">9</a>
                                                </span>
                                                <span class="quiz-navigation-questions-number">
                                                    <a href="#">10</a>
                                                </span>
                                            </div>
                                            <a href="#" class="quiz-navigation-finish">Finish attempt...</a>
                                            <div class="quiz-navigation-timer">
                                                <span class="quiz-navigation-time-left"> Time left </span>
                                                <div class="quiz-navigation-time">
                                                    <span class="quiz-navigation-time-hours">01</span>:
                                                    <span class="quiz-navigation-time-minutes">35</span>:
                                                    <span class="quiz-navigation-time-seconds">30</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php $this->view("include/footer"); ?>
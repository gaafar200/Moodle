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
                                <div class="quiz-wrapper">
                                    <div class="course-name-wrapper">
                                        <h4 class="course-name">Digital Electronics</h4>
                                    </div>
                                    <div class="quiz-details-wrapper">
                                        <div class="quiz-details-one">
                                            <span class="quiz-details-one-name"> Quiz Chapter 7 </span>
                                            <p class="quiz-details-one-description">This quiz covers Chapter 7</p>
                                        </div>
                                        <div class="quiz-details-two">
                                            <span class="quiz-details-two-attempts">
                                                Attempts allowed: <span>2</span>
                                            </span>
                                            <span class="quiz-details-two-date">
                                                This quiz closed on <span>Monday, 6 March 2023, 11:59 PM</span>
                                            </span>
                                            <span class="quiz-details-two-time">
                                                Time limit: <span>10 mins</span>
                                            </span>
                                            <span class="quiz-details-two-method">
                                                Grading method: <span>Highest grade</span>
                                            </span>
                                        </div>
                                        <div class="quiz-details-three">
                                            <span class="quiz-details-three-summary">
                                                Summary of your previous attempts
                                            </span>
                                            <table class="grade-table">
                                                <thead>
                                                    <tr>
                                                        <th class="grade-tabl-width">Attempt</th>
                                                        <th>State</th>
                                                        <th class="grade-tabl-width">Grade / <span>4</span></th>
                                                        <th class="grade-tabl-width">Review</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td class="grade-table-state">
                                                            <span>Finished</span>
                                                            <span>Submitted Monday, 6 March 2023, 4:09 PM</span>
                                                        </td>
                                                        <td>3.5</td>
                                                        <td><a href="">Review</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td class="grade-table-state">
                                                            <span>Finished</span>
                                                            <span>Submitted Monday, 6 March 2023, 4:09 PM</span>
                                                        </td>
                                                        <td>2.5</td>
                                                        <td><a href="">Review</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <span class="quiz-details-three-grade">
                                                Your final grade for this quiz is <span> 4/4</span>.
                                            </span>
                                        </div>
                                        <div class="quiz-details-four">
                                            <button class="quiz-details-four-attempt">Attempt Quiz</button>
                                            <button class="quiz-details-four-back">Back to the course</button>
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
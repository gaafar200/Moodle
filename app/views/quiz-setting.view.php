<?php $this->view("include/header",["pageName"=>$pageName]); ?>
<?php $this->view("include/sidebar"); ?>
<?php $this->view("include/upbar",["user"=>$user]); ?>
    <style>
        .myDiv {
            display: none;
            padding: 10px;
            margin-top: 20px;
        }

        #showOne {
            border: 1px solid green;
        }

        #showTwo {
            border: 1px solid green;
        }

        #showThree {
            border: 1px solid green;
        }
    </style>
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
</div>
<!-- Single pro tab review Start-->
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-payment-inner-st">
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Quiz Informations</a></li>
                                <li><a href="#reviews"> Quiz Questions</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad">
                                                    <form action="/upload"
                                                        class="dropzone dropzone-custom needsclick add-professors"
                                                        id="demo1-upload">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="quiz-name">Quiz Name</label>
                                                                    <input required name="quiz-name" type="text"
                                                                        id="quiz-name" class="form-control"
                                                                        placeholder="Quiz Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="date">Date</label>
                                                                    <input required name="date" id="date" type="date"
                                                                        class="form-control" placeholder="Date">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="start-time">Start Time</label>
                                                                    <input required name="start-time" type="time"
                                                                        id="start-time" class="form-control"
                                                                        placeholder="Start Time">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end-time">End Time</label>
                                                                    <input required name="end-time" type="time"
                                                                        id="end-time" class="form-control"
                                                                        placeholder="End Time">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end-time">Number Of Questions</label>
                                                                    <input required name="number-of-questions"
                                                                        type="number" id="number-of-questions"
                                                                        class="form-control"
                                                                        placeholder="Number Of Questions">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="final-mark">Final Mark</label>
                                                                    <input required name="final-mark" type="number"
                                                                        id="final-mark" class="form-control"
                                                                        placeholder="Final Mark">
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="number-of-attempts">Number Of
                                                                        Attempts</label>
                                                                    <input required name="number-of-attempts"
                                                                        type="number" id="number-of-attempts"
                                                                        class="form-control"
                                                                        placeholder="Number Of Attempts">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="move-between-questions">Move between
                                                                        questions</label>
                                                                    <select required name="Move between questions"
                                                                        id="move-between-questions"
                                                                        class="form-control">
                                                                        <option value="none" selected="" disabled="">
                                                                            Move between questions</option>
                                                                        <option value="0">NO</option>
                                                                        <option value="1">Yes</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="auto-correct">Auto Correct</label>
                                                                    <select required name="Auto Correct"
                                                                        class="form-control" id="auto-correct">
                                                                        <option value="none" selected="" disabled="">
                                                                            Auto Correct</option>
                                                                        <option value="0">NO</option>
                                                                        <option value="1">Yes</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group res-mg-t-15">
                                                                    <label for="description-quiz">Description</label>
                                                                    <textarea required name="description-quiz"
                                                                        id="description-quiz"
                                                                        placeholder="Description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="payment-adress">
                                                                    <button type="submit"
                                                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-tab-list tab-pane fade" id="reviews">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <form action="/upload"
                                                            class="dropzone dropzone-custom needsclick add-professors"
                                                            id="demo1-upload">
                                                            <div class="devit-card-custom">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Question">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Grade">
                                                                </div>
                                                                <select id="myselection" required name="myselection"
                                                                    class="form-control">
                                                                    <option value="none" selected="" disabled="">
                                                                        Type Question</option>
                                                                    <option value="One"> True Or False
                                                                    </option>
                                                                    <option value="Two">Multiple Choice
                                                                    </option>
                                                                    <option value="Three">Essay Question
                                                                    </option>
                                                                </select>

                                                                <div id="showOne" class="myDiv">
                                                                    <select required name="Correct-answer"
                                                                        id="Correct-answer" class="form-control">
                                                                        <option value="none" selected="" disabled="">
                                                                            Correct Answer</option>
                                                                        <option value="0">False</option>
                                                                        <option value="1">True</option>
                                                                    </select>
                                                                </div>
                                                                <div id="showTwo" class="myDiv">
                                                                    <select required name="multiple-answer"
                                                                        id="multiple-answer" class="form-control">
                                                                        <option value="none" selected="" disabled="">
                                                                            multiple-answer</option>
                                                                        <option value="0">No</option>
                                                                        <option value="1">Yes</option>
                                                                    </select>
                                                                    </select>
                                                                    <div class="form-group">
                                                                        <input name="choice1" type="text"
                                                                            class="form-control"
                                                                            placeholder="Choice One">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input name="choice2" type="text"
                                                                            class="form-control"
                                                                            placeholder="Choice Tow">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input name="choice3" type="text"
                                                                            class="form-control"
                                                                            placeholder="Choice Three">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input name="choice4" type="text"
                                                                            class="form-control"
                                                                            placeholder="Choice Four">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input name="correct-answer" type="text"
                                                                            class="form-control"
                                                                            placeholder="Correct Answer">
                                                                    </div>
                                                                </div>
                                                                <div id="showThree" class="myDiv">
                                                                    <div class="form-group res-mg-t-15">
                                                                        <textarea name="correct-answer"
                                                                            placeholder="Correct Answer"></textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-group alert-up-pd">

                                                                <label for="images" class="drop-container">
                                                                    <span class="drop-title">Drop image here</span>
                                                                    or
                                                                    <input name="image" type="file" id="images"
                                                                        accept="image/*">
                                                                    <?php if(isset($errors) && isset($errors["image"])): ?>
                                                                    <em for="image"
                                                                        class="invalid"><?= ucfirst($errors["image"]) ?></em>
                                                                    <?php endif; ?>
                                                                </label>
                                                            </div>

                                                            <div class="row" style="margin: 100px;">
                                                                <div class="col-lg-12">
                                                                    <div class="payment-adress">
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myselection').on('change', function () {
                var demovalue = $(this).val();
                $("div.myDiv").hide();
                $("#show" + demovalue).show();
            });
        });

    </script>

<?php $this->view("include/footer"); ?>
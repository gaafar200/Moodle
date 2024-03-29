<?php $this->view('include/header', ['pageName' => $pageName]); ?>
<?php $this->view('include/sidebar'); ?>
<?php $this->view('include/upbar', ['user' => $user]); ?>
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
        <div class="row" style="margin-top:100px ;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul class="collapse dropdown-header-top">
                                    <li><a href="index.html">Dashboard</a></li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
                            <li><a data-toggle="collapse" data-target="#demopro" href="#">Students <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
                            <li><a data-toggle="collapse" data-target="#democrou" href="#">Courses <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
                            <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                <ul id="demo" class="collapse dropdown-header-top">
                                    <li><a href="mailbox.html">Inbox</a>
                                    </li>
                                    <li><a href="mailbox-view.html">View Mail</a>
                                    </li>
                                    <li><a href="mailbox-compose.html">Compose Mail</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
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
        <div class="row" style="margin-top:100px ;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <form method="POST" class=" dropzone-custom needsclick add-professors" id="demo1-upload" enctype="multipart/form-data">
                        <div class="devit-card-custom">
                            <div class="form-group">
                                <input type="text" value="<?= displayQuestion($question_data) ?>" name="question" class="form-control" placeholder="Question">
                            </div>
                            <div class="form-group">
                                <input type="number" value="<?= displayQuestionMark($question_data) ?>" name="mark" class="form-control" placeholder="Grade">
                            </div>
                            <select id="myselection" required name="question_type" class="form-control">
                                <option value="none" selected="" disabled="">
                                    Type Question</option>
                                <option value="One" <?= checkIfQuestionIsOfThisType($question_data,"One")?>> True Or False
                                </option>
                                <option value="Two" <?= checkIfQuestionIsOfThisType($question_data,"Two")?>>Multiple Choice
                                </option>
                                <option value="Three" <?= checkIfQuestionIsOfThisType($question_data,"Three")?>>Essay Question
                                </option>
                            </select>

                            <div id="showOne" class="myDiv">
                                <select required name="correct_answer" id="Correct-answer" class="form-control">
                                    <option value="none" selected="" disabled="">
                                        Correct Answer</option>
                                    <option value="true" <?= checkIfThisIsRightAnswer($question_data,$question_choice[1],"trueOrFalse") ?>>True</option>
                                    <option value="false" <?= checkIfThisIsRightAnswer($question_data,$question_choice[0],"trueOrFalse") ?>>False</option>
                                </select>
                            </div>
                            <div id="showTwo" class="myDiv">
                                <select required name="multiple_answer" id="multiple-answer" class="form-control">
                                    <option value="none" selected="" disabled="">
                                        multiple-answer</option>
                                    <option value="no" <?= checkIfQuestionHaveMultibleAnswer($question_data,$question_choice,"multiableChoice","no") ?>>No</option>
                                    <option value="yes">Yes</option>
                                </select>
                                </select>
                                <div class="form-group">
                                    <input name="choice1" value="<?= displayQuestionChoice($question_data,$question_choice[0],"multiableChoice") ?>" type="text" class="form-control" placeholder="Choice One">
                                </div>
                                <div class="form-group">
                                    <input name="choice2" value="<?= displayQuestionChoice($question_data,$question_choice[1],"multiableChoice") ?>" type="text" class="form-control" placeholder="Choice Tow">
                                </div>
                                <div class="form-group">
                                    <input name="choice3" value="<?= displayQuestionChoice($question_data,$question_choice[2],"multiableChoice") ?>" type="text" class="form-control" placeholder="Choice Three">
                                </div>
                                <div class="form-group">
                                    <input name="choice4" value="<?= displayQuestionChoice($question_data,$question_choice[3],"multiableChoice") ?>" type="text" class="form-control" placeholder="Choice Four">
                                </div>
                                <div class="form-group">
                                    <input name="correct_answers" value="<?= displayQuestionCorrectAnswers($question_data,$question_choice,"multiableChoice") ?>" type="text" class="form-control" placeholder="Correct Answer">
                                </div>
                            </div>

                        </div>
                        <div class="form-group alert-up-pd">

                            <label for="images" class="drop-container">
                                <span class="drop-title">Drop image here</span>
                                or
                                <input name="image" type="file" id="images" accept="image/*">
                                <?php if (isset($errors) && isset($errors['image'])) : ?>
                                    <em for="image" class="invalid"><?= ucfirst($errors['image']) ?></em>
                                <?php endif; ?>
                            </label>
                        </div>

                        <div class="row" style="margin: 100px;">
                            <div class="col-lg-12">
                                <div class="payment-adress">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myselection').on('change', function() {
            var demovalue = $(this).val();
            $("div.myDiv").hide();
            $("#show" + demovalue).show();
        });
    });
</script>

<?php $this->view('include/footer'); ?>
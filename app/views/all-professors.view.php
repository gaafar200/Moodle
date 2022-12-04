<?php $this->view("include/header"); ?>
<?php  $this->view("include/sidebar");?>
<?php $this->view("include/upbar",["user"=>$user[0]]); ?>

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
                            <div class="breadcome-list" style="margin-top: 10vh;">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                            <form role="search" class="sr-input-func">
                                                <input type="text" placeholder="Search..."
                                                    class="search-int form-control">
                                                <a href="#"><i class="fa fa-search"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">All Professors</span>
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
        <div class="contacts-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
                            <div id="id01" class="modal-delete">
                                <span onclick="document.getElementById('id01').style.display='none'" class="close-delete" title="Close Modal">×</span>
                                <form class="modal-content" action="/action_page.php">
                                    <div class="container-delete">
                                    <h1>Delete Account</h1>
                                    <p>Are you sure you want to delete account?</p>
                                    
                                    <div class="clearfix">
                                        <button class="btn-delete cancelbtn" type="button" onclick="document.getElementById('id01').style.display='none'" >Cancel</button>
                                        <a href="#">
                                             <button class="btn-delete deletebtn" type="button" onclick="document.getElementById('id01').style.display='none'">Delete</button>
                                        </a>
                                       
                                    </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/1.jpg">
                                <h3><a href="">John Alva</a></h3>
                                <p class="all-pro-ad">London, LA</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/2.jpg">
                                <h3><a href="">Amir dex</a></h3>
                                <p class="all-pro-ad">Pakistan, Los</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div
                            class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/3.jpg">
                                <h3><a href="">Alva Adition</a></h3>
                                <p class="all-pro-ad">India, Col</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs res-tablet-mg-t-30 dk-res-t-pro-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/4.jpg">
                                <h3><a href="">Sex Dog</a></h3>
                                <p class="all-pro-ad">Uk, LA</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs mg-t-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/1.jpg">
                                <h3><a href="">Fox Well</a></h3>
                                <p class="all-pro-ad">California, LA</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs mg-t-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/3.jpg">
                                <h3><a href="">Drom Simson</a></h3>
                                <p class="all-pro-ad">Austrolia, LA</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs mg-t-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/2.jpg">
                                <h3><a href="">Sima son</a></h3>
                                <p class="all-pro-ad">Suiden, Cro</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="hpanel hblue contact-panel contact-panel-cs mg-t-30">
                            <div class="panel-body custom-panel-jw">
                                <img alt="logo" class="img-circle m-b" src="<?= ASSETS ?>img/contact/4.jpg">
                                <h3><a href="">Drama Son</a></h3>
                                <p class="all-pro-ad">USA, LA</p>
                                <p>
                                    Lorem ipsum dolor sit amet of, consectetur adipiscing elitable. Vestibulum tincidunt
                                    est vitae ultrices accumsan.
                                </p>
                                <div>
                                   <a href="#"> <button type="button" class="btn btn-custon-rounded-four btn-primary">Profile</button></a>
                                   <button type="button" class="btn btn-custon-rounded-four btn-danger" onclick="document.getElementById('id01').style.display='block'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<?php $this->view("include/footer"); ?>

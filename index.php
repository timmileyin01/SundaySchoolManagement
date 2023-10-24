<?php include './includes/header.php'; 


include './admin/controllers/users.php';

?>

    <!--navigation-->
  <?php include './includes/topNav.php'; ?>
    <!--end of navigation bar-->


    <!--welcome section-->
    <section id="home">
        <div class="sub-home max-width">
            <h2>The Ekklesia Sunday School Lessons</h2>
            <p>
               Weekly Life-changing Sunday School Lessons
               <?= $_SESSION['unique_id']; ?>
            </p>
            <a href="#next" class="btn-special">Explore</a>
        </div>
    </section>
    <!--welcome section ends here-->

    <!--project counter starts here-->
    <div id="next" class="no-of-projects">
        <div class="project-counter">
            <h3>Read From the available Lessons</h3>
            <span class="special-no-count">
                56
            </span>
        </div>
    </div>
    
    <div class="search-bar">
        <div class="inputs">
        <form action="projects.html" method="post">
            <input type="text" name="search-term" placeholder="Enter your search">
        </form>
        </div>
    </div>




    <div class="main-container max-width">
        <div class="item-container-main">
            <h2>Recent Lessons</h2>
            <div class="items-inside-main">
                <div class="each-faculty">
                    <div class="single-project">
                        <i class="fa-solid fa-file large"></i>
                        <div class="project">
                            <div class="project-content">
                                <h3 class="info-head">Lesson for Sunday (23-4-2023)</h3>
                                <a href="single-lesson.html">
                                    <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus facilis est deserunt?</h3>
                                   <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum nostrum reprehenderit architecto iusto delectus possimus. Sit libero assumenda ex ipsum itaque laboriosam porro, culpa voluptatibus distinctio, iusto iste nobis!</p>
                                </a>
                            </div>
                            <div class="project-details">
                                <small class="author text-muted">Pst. S. Ola Augustus</small>
                                <small class="comments text-muted"><span> 8 </span> Comments </small>
                                <small class="date text-muted">23-9-2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="single-project">
                        <i class="fa-solid fa-file large"></i>
                        <div class="project">
                            <div class="project-content">
                                <h3 class="info-head">Lesson for Sunday (23-4-2023)</h3>
                                <a href="single-lesson.html">
                                    <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus facilis est deserunt?</h3>
                                   <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum nostrum reprehenderit architecto iusto delectus possimus. Sit libero assumenda ex ipsum itaque laboriosam porro, culpa voluptatibus distinctio, iusto iste nobis!</p>
                                </a>
                            </div>
                            <div class="project-details">
                                <small class="author text-muted">Pst. S. Ola Augustus</small>
                                <small class="comments text-muted"><span> 8 </span> Comments </small>
                                <small class="date text-muted">23-9-2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="single-project">
                        <i class="fa-solid fa-file large"></i>
                        <div class="project">
                            <div class="project-content">
                                <h3 class="info-head">Lesson for Sunday (23-4-2023)</h3>
                                <a href="single-lesson.html">
                                    <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus facilis est deserunt?</h3>
                                   <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum nostrum reprehenderit architecto iusto delectus possimus. Sit libero assumenda ex ipsum itaque laboriosam porro, culpa voluptatibus distinctio, iusto iste nobis!</p>
                                </a>
                            </div>
                            <div class="project-details">
                                <small class="author text-muted">Pst. S. Ola Augustus</small>
                                <small class="comments text-muted"><span> 8 </span> Comments </small>
                                <small class="date text-muted">23-9-2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="single-project">
                        <i class="fa-solid fa-file large"></i>
                        <div class="project">
                            <div class="project-content">
                                <h3 class="info-head">Lesson for Sunday (23-4-2023)</h3>
                                <a href="single-lesson.html">
                                    <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus facilis est deserunt?</h3>
                                   <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum nostrum reprehenderit architecto iusto delectus possimus. Sit libero assumenda ex ipsum itaque laboriosam porro, culpa voluptatibus distinctio, iusto iste nobis!</p>
                                </a>
                            </div>
                            <div class="project-details">
                                <small class="author text-muted">Pst. S. Ola Augustus</small>
                                <small class="comments text-muted"><span> 8 </span> Comments </small>
                                <small class="date text-muted">23-9-2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="single-project">
                        <i class="fa-solid fa-file large"></i>
                        <div class="project">
                            <div class="project-content">
                                <h3 class="info-head">Lesson for Sunday (23-4-2023)</h3>
                                <a href="single-lesson.html">
                                    <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus facilis est deserunt?</h3>
                                   <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum nostrum reprehenderit architecto iusto delectus possimus. Sit libero assumenda ex ipsum itaque laboriosam porro, culpa voluptatibus distinctio, iusto iste nobis!</p>
                                </a>
                            </div>
                            <div class="project-details">
                                <small class="author text-muted">Pst. S. Ola Augustus</small>
                                <small class="comments text-muted"><span> 8 </span> Comments </small>
                                <small class="date text-muted">23-9-2023</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-info">
                <div class="page_num_info">
                    
                    Showing 1 of 5 page(s)
                </div>
                
            </div>
            </div>
        </div>
        <div class="item-container-aside">
            <h2>Featured Lessons</h2>
            <div class="recent-projects">

                <div class="project-item">
                    <a href="#">
                        <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, sapiente.</h3>
                    </a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, deleniti modi. Nemo quas sunt ut libero ad inventore quae, maiores, aliquid a commodi nihil debitis, ducimus placeat voluptatum nisi at. Enim, odio. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque deserunt odio reiciendis eius eos similique cupiditate repellendus minus tempore. Voluptates labore natus consequuntur minus sequi cupiditate hic, similique distinctio magnam ducimus cumque?</p>
                    <div class="project-details">
                        <small class="author text-muted">Pst. S. Ola Augustus</small>
                        <small class="date text-muted">Published on: 23-10-2023</small>
                    </div>
                </div>
                <div class="project-item">
                    <a href="#">
                        <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, sapiente.</h3>
                    </a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, deleniti modi. Nemo quas sunt ut libero ad inventore quae, maiores, aliquid a commodi nihil debitis, ducimus placeat voluptatum nisi at. Enim, odio. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque deserunt odio reiciendis eius eos similique cupiditate repellendus minus tempore. Voluptates labore natus consequuntur minus sequi cupiditate hic, similique distinctio magnam ducimus cumque?</p>
                    <div class="project-details">
                        <small class="author text-muted">Pst. S. Ola Augustus</small>
                        <small class="date text-muted">Published on: 23-10-2023</small>
                    </div>
                </div>
                <div class="project-item">
                    <a href="#">
                        <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, sapiente.</h3>
                    </a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, deleniti modi. Nemo quas sunt ut libero ad inventore quae, maiores, aliquid a commodi nihil debitis, ducimus placeat voluptatum nisi at. Enim, odio. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque deserunt odio reiciendis eius eos similique cupiditate repellendus minus tempore. Voluptates labore natus consequuntur minus sequi cupiditate hic, similique distinctio magnam ducimus cumque?</p>
                    <div class="project-details">
                        <small class="author text-muted">Pst. S. Ola Augustus</small>
                        <small class="date text-muted">Published on: 23-10-2023</small>
                    </div>
                </div>
                <div class="project-item">
                    <a href="#">
                        <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, sapiente.</h3>
                    </a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, deleniti modi. Nemo quas sunt ut libero ad inventore quae, maiores, aliquid a commodi nihil debitis, ducimus placeat voluptatum nisi at. Enim, odio. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque deserunt odio reiciendis eius eos similique cupiditate repellendus minus tempore. Voluptates labore natus consequuntur minus sequi cupiditate hic, similique distinctio magnam ducimus cumque?</p>
                    <div class="project-details">
                        <small class="author text-muted">Pst. S. Ola Augustus</small>
                        <small class="date text-muted">Published on: 23-10-2023</small>
                    </div>
                </div>
                <div class="project-item">
                    <a href="#">
                        <h3>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, sapiente.</h3>
                    </a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, deleniti modi. Nemo quas sunt ut libero ad inventore quae, maiores, aliquid a commodi nihil debitis, ducimus placeat voluptatum nisi at. Enim, odio. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque deserunt odio reiciendis eius eos similique cupiditate repellendus minus tempore. Voluptates labore natus consequuntur minus sequi cupiditate hic, similique distinctio magnam ducimus cumque?</p>
                    <div class="project-details">
                        <small class="author text-muted">Pst. S. Ola Augustus</small>
                        <small class="date text-muted">Published on: 23-10-2023</small>
                    </div>
                </div>
            </div>



            
        </div>




    </div>





    <!--footer-->
<div id="footer">
    <div class="main-widgets">
        <div class="widget-1">
            <h3>About Ekklesia</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad commodi repellat atque inventore, voluptatibus animi saepe omnis non libero sit error quia optio nostrum odit iste molestiae asperiores autem nihil est! Rem!</p>
        </div>
        <div class="widget-2">
            <h3>Quick-links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Lessons</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">FAQs</a></li>
            </ul>
        </div>
        <div class="widget-3" id="contact">
            <h3>Send a Message</h3>
            <form action="index.php" method="post">
                <input type="text" name="name" placeholder="Enter your name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <textarea rows="4" name="message" placeholder="Your Message..." required></textarea>
                <button type="submit" name="send" class="btn">Send</button>
            </form>
        </div>
    </div>
    <div class="copyright">
        <small class="text-muted">Developed by</small>
        <a href="#">Timmy</a>
    </div>
</div>

<script src="./js/main.js"></script>
<script src="./js/theme-toggler.js"></script>
</body>
</html>
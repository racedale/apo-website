<!--<div id="lefttriangle"></div>-->
    <a href="#nav" title="Show navigation">Show</a>
  <a href="#" title="Hide navigation">Hide</a>
  <ul class="clearfix">
    <li><a href="index.php">Home</a></li>
    <li>
      <a href="?about" aria-haspopup="true"><span>About</span></a>
      <ul>
        <li><a href="join.php">Join</a></li>
        <li><a href="history.php">History</a></li>
        <li><a href="dates.php">Important Dates</a></li>
        <li><a href="awards.php">Awards</a></li>
        <li><a href="traditions.php">Traditions</a></li>    
      </ul>
    </li>
    <li>
      <a href="?work" aria-haspopup="true"><span>Our Members</span></a>
      <ul>
        <li><a href="exec.php">Executive Board</a></li>
        <li><a href="actives.php">Actives</a></li>
        <li><a href="alumni.php">Alumni</a></li>
        <li><a href="advisors.php">Advisors</a></li>
      </ul>
    </li>
    <li>
      <a href="?active" aria-haspopup="true"><span>Active</span></a>
            <ul>
                <li><a href="login.php">Login/Logout</a></li>
                    <li><a href="attendance.php">Attendance</a></li>
                    <li><a href="https://docs.google.com/document/d/15-J7-iN9vKM0x3l0wS_EtOiuRgd-lAal-sa-UomSXBY">Bylaws</a></li>
                    <li><a href="calendar.php">Calendar</a></li>
                    <li><a href="service_hours.php">Hours</a></li>
                    <li><a href="service_signup.php">Service Signups</a></li>
                    <li><a href="risk_management_quiz.php">Risk Management Quiz</a></li>
                    <li><a href="members_list.php">Members Info</a></li>
                    <li><a href="updateinfo.php">Update Info</a></li>
                    <li><a href="upload_photo.php">Upload Photo</a></li>
            </ul>
        </li>
    <li>
            <a href="?exec" aria-haspopup="true"><span>Executive</span></a>
                <ul>
                    <li><a href="service_admin.php">service admin</a></li>
                    <li><a href="service_admin_week.php">service admin week</a></li>
  
                    <li><a href="attendance_admin.php">Record Attendance</a></li>
                    <li><a href="attendance_check.php">Check Attendance</a></li>
                    <li><a href="check_hours.php">Check Hours</a></li>
                    <li><a href="edit_exec.php">Edit Exec</a></li>
                    <li><a href="member_statuses.php">Edit Members</a></li>
                </ul>
        </li>
<?php
      include('mysql_access.php');
      $response=$db->query("SELECT * FROM important_links ORDER BY link_id");
?>
        <li>
            <a href="?links" aria-haspopup="true"><span>Links</span></a>
                <ul>
                  <?php
                      while($result=mysqli_fetch_array($response)){ 
                        echo '<li><a href="' . $result['link_URL'] . '">' . $result['link_title'] . '</a></li>';
                      }
                  ?>
                  <li><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                      <input type="hidden" name="cmd" value="_s-xclick">
                      <input type="hidden" name="hosted_button_id" value="PEA3YS23SH8BY">
                      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                      </form></li>
                </ul>
        </li>
  </ul>
    <!--<div id="righttriangle"></div>-->

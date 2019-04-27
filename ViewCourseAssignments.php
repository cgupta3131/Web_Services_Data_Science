<?php
  session_start();

  include("config.php");

  // $CourseID = $_SESSION['CourseID'];

  if(isset($_POST["submit"])){
    $NoticeHead = $_POST['NoticeHead'];
    $NoticeBody = ($_POST["NoticeBody"]);
    $Username = $_SESSION['Username'];
    // $CourseID = $_SESSION['CourseID'];
    $CourseID = 'CS243';
    $query = mysqli_query($connection, "INSERT into CourseNotices(CourseID, Username, NoticeHead, NoticeBody) values('$CourseID', '$Username', '$NoticeHead', '$NoticeBody')");
  }
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include('top_nav.php'); ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
      </ul>
    </div>
  </nav>


  <a href='AddCourseAssignment.php'><p class='options'>Add assignment</p></a>

  <ul class="cards">
  <?php

  include("config.php");

  // $CourseID = $_SESSION['CourseID'];
  $CourseID = 'CS243';

  $query = mysqli_query($connection, "SELECT * FROM CourseAssignments WHERE CourseID='$CourseID'");

  while($row = mysqli_fetch_assoc($query)){
      echo "<li class='cards__item'>
        <div class = 'card'>
        <div class='card__content'>
          <div class='card__title'>{$row['AssignmentID']}</div>
          <div class='card__subtitle'>Deadline: {$row['Deadline']}</div>
          <p class='card__text'>{$row['Details']}</p>
        </div>
        </div>
      </li>";

  }

  ?>
  </ul>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


<!-- {% extends "base_generic.html"%}

{% block sidebar %}
  {% if Designation == 'Faculty' %}
  <li>
    <a href="{% url 'course:random_groups' cinfo aid %}">Randomly Allocate Groups</a>
  </li>
  <li>
    <a href="{% url 'course:view_course' cinfo%}">Assignments</a>
  </li>
  <li>
    <a href="{% url 'discussion:events' cinfo %}">Events</a>
  </li>
  <li>
    <a href="{% url 'discussion:notice_board' cinfo %}">Noticeboard</a>
  </li>
  <li>
    <a href="{% url 'discussion:course_group' cinfo 1 %}">Discussion Room</a>
  </li>
  {% else %}
  <li>
    <a href="{% url 'course:view_course' cinfo%}">Assignments</a>
  </li>

  <li>
    <a href="{% url 'discussion:events' cinfo %}">Events</a>
  </li>
  <li>
    <a href="{% url 'discussion:notice_board' cinfo %}">Noticeboard</a>
  </li>
  <li>
    <a href="{% url 'discussion:course_group' cinfo 1 %}">Discussion Room</a>
  </li>
  {% endif %}
{% endblock %}

{% block content %}

{% comment %} <a href="{% url 'course:add_course'%}"><p class="options">Add Group</p></a> {% endcomment %}

<ul class="cards">
{% for group in MyGroupList %}

    <li class="cards__item">
      <div class = "card">
      <div class="card__content">
        <div class="card__title"><a href="{% url 'course:view_group' cinfo aid group.GroupID %}">{{ group.GroupID }}</a></div>
        {% if Designation == 'Faculty' %}
        <a href="{% url 'course:update_attendance' cinfo aid group.GroupID %}"><button class="btn btn--block card_btn">Update Attendance</button></a>
        <a href="{% url 'course:add_grade' cinfo aid group.GroupID %}"><button class="btn btn--block card_btn">Add Grade</button></a>
        {% else %}
        <a href="{% url 'discussion:group' cinfo aid group.GroupID %}" class="card-link"><button class="btn btn--block card_btn">Group Chat</button></a>
        {% endif %}
      </div>
      </div>
    </li>

{% endfor %}
</ul>
{% endblock %} -->

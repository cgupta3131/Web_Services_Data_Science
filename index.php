<?php
session_start();
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php include("top_nav.php"); ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Students/select_course.php">Apply for course</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Students/change_password.php">Change Password</a>
        </li>



        <li class="nav-item">
          <a class="nav-link" href="./Faculty/add_course.php">Add New Course</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Faculty/view_course.php">My Courses</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./Faculty/request_course.php">Student Requests</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./Faculty/students_courses.php">My Students</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="./Staff/all_applicants.php">View Applicants</a>
        </li>
      </ul>
    </div>
  </nav>

<div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-2'></div>
        <div class='col'>

  <div id="myCarousel" class="carousel slide embed-responsive embed-responsive-16by9" data-ride="carousel">

      <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>

  <div class="carousel-inner embed-responsive-item">

    <div class="carousel-item active">
      <img src="media/home/Data-Science-vs.-Big-Data-vs.jpg" class="d-block w-100 h-100" alt="image">
    </div>

    <div class="carousel-item">
      <img src="media/home/1_QGWyxDaFhavZa495eJBO9Q.jpeg" class="d-block w-100 h-100" alt="image">
    </div>

    <div class="carousel-item">
      <img src="media/home/spa-datascience-news.jpg" class="d-block w-100" alt="image">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control carousel-control-prev" href="#myCarousel" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control carousel-control-next" href="#myCarousel" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>




</div>
<div class='col-lg-2'></div>
</div>
</div>


<div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-1'></div>
        <div class='col'>
<p class='form-control-plaintext'>It’s been said that Data Scientist is the“sexiest job title of the 21st century.” Why is it such a demanded position these days? The short answer is that over the last decade there’s been a massive explosion in both the data generated and retained by companies, as well as you and me. Sometimes we call this “big data,” and like a pile of lumber we’d like to build something with it. Data scientists are the people who make sense out of all this data and figure out just what can be done with it.</p>

<p class='form-control-plaintext'>At Alexa, our Data team is at the helm of generating robust, actionable analytics from immense data sets. It’s these efforts that bring clarity to how people interact with the web and are the basis for usable features that inform critical business strategies. The demand for data scientists is increasing so quickly, that McKinsey predicts that by 2018, there will be a 50 percent gap in the supply of data scientists versus demand. Great for us, but what is data science? What exactly do we do with all that data?</p>

<p class='form-control-plaintext'><b>What is Data Science?</b><br>

A data scientist is the adult version of the kid who can’t stop asking “Why?”.  They’re the kind of person who goes into an ice cream shop and gets five different scoops on their cone because they really need to know what each one tastes like. Similarly, even the term data scientist is a catchall title that encompasses many different flavors of work. I think that’s the major differentiator between a data scientist and a statistician or an analyst or an engineer; the data scientist is doing a little of each of those tasks. Of course, what someone whose job title is data scientist will do at a given company depends on the company and the person, and may look more like one of those other titles, rather than a mixture of all three. To me, a data scientist is someone who does the following tasks:
<br>
1. Data analysis<br>
2. Modeling/statistics<br>
3. Engineering/prototyping<br>

The order of these tasks is intentional, and it roughly reflects the life cycle of a data science project. To be fair, we should add “0.
Data cleaning” to that list, as it can be one of the most time consuming tasks of a data scientist. It’s also an incredible litmus test for
data scientists. Someone who can’t parse a messy CSV isn’t going to cut it as a data scientist). Let’s look at these tasks in more detail.</p>

<p class='form-control-plaintext'><b>Data cleaning</b><br>

There’s lot’s of data out there, but much of it is not in an easy to use format. This part of a data scientist’s job involves making sure
that data is nicely formatted and conforms to some set of rules.<br>

As an example, consider a CSV where each row describes the finances of a fast food franchise. There might be columns for city, state, and number of burgers sold in the last year. But, rather than having all this data in one document (that would be too easy, right?), it probably comes spread across many different files, which need to be joined together. Doing this is in some sense the easy part. The hard part is making sure the resulting combination makes sense. Typically there will be some formatting inconsistencies, and floating somewhere in the data set is a row where the number of burgers sold is ‘Idaho’ and the state is
25,000. Data cleaning is all about finding these hiccups, fixing them, and making sure they’ll be fixed automatically in the future. As an
added bonus, all the downstream work from this point can only be as good as the data you’ve assembled.</p>

<p class='form-control-plaintext'><b>Data analysis</b><br>

This is the sort of work most people think of using Excel for, but dramatically juiced up. A data scientist will typically work with data sets
that are too large to open in a typical spreadsheet program, and may even be too large to work with on a single computer.<br>

Data analysis is the realm of visualization (tables are for robots). This is where you make lots of plots of the data in an attempt to understand it (plotting is also another place where spreadsheets start lagging behind). Through this process, a data scientist is trying to craft a story, explaining the data in a way that will be easy to communicate and easy to act on. Sometimes this can be something simple, like figuring out what property or event signals when new users convert into long-term users, or something more complex, like figuring out when someone is slowly scamming you for lots of money ala Office Space. For example,
data scientists at Facebook figured out that having at least ten friends helps guarantee that a user will stay active on the site, which is
why there is so much machinery on the site devoted to finding new friends.</p>

<p class='form-control-plaintext'><b>Modeling/statistics</b><br>

Whether a data scientist thinks they’re doing modeling or statistics depends on their background. People who studied statistics consider
themselves to be statisticians; everyone else is probably going to claim to be more of a modeler (or an expert in machine learning if they’re
feeling fancy).<br>

My own background is in the purest of pure mathematics, so I think of statistics as a funny way of talking about probability and regression as
a bunch of linear algebra. This makes me a modeler. In either case, this is where deep theoretical knowledge creeps in to data science. Once
you’ve got clean data and an understanding of that data, you generally want to make predictions either from that data or similar looking data
that you’ll get in the future.<br>

One of the problems we’re tackling at Alexa, is predicting how many visitors a website gets. To do this we’ve built a model based on what we
know about traffic to individual websites as well as how people interact with the web. There’s a lot going on there, and it’s really the
subject of a separate blog post. However, I’ll just add that this step is often very complicated. We live in a golden age of machine learning,
where very powerful algorithms are available as black boxes that produce good results. However, it’s easy to find yourself sitting on a problem
that no model is going to work well on right out of the box. So a data
scientist spends a lot of time evaluating and tweaking models, as well as going back to the data to bring out new features that can help make
better models.</p>

<p class='form-control-plaintext'><b>Engineering/prototyping</b><br>

Having clean data and a good model is only the tip of the iceberg. Going back to the visitor model in the last section, even if I’ve got a good model for predicting how many people visit a site (I’d like to think I do), it doesn’t do anyone much good if I can’t give those predictions to our customers and do it consistently. This means building some sort of data product that can be used by people who aren’t data scientists. This can take many forms: a visualization (or chart), a metric on a dashboard, or an application.<br>

Whether a data scientist is building a full on application or just a proof of concept often depends on how much data is involved, how snappy things need to be, and who the final consumers are going to be. We’re still in the early days of engineering with a slant towards projects that utilize large amounts of data, and so many of the tools and techniques that make general programming easier either aren’t available in the tools used by most data or don’t work quite as well in their new context (unit tests come to this data scientist’s mind).</p>

<p class='form-control-plaintext'><b>Wrap Up</b><br>

Remember that ice cream cone I mentioned earlier? At the end of the cone, you get a melted mess of all your favorite flavors. The long-term life cycle of a data science project looks a lot like that. You go back and redo your analysis because you had a great insight in the shower, a new source of data comes in and you have to incorporate it, or your prototype gets far more use than you expected. This is the best thing about data science: you do a lot of things and you do them together, and it’s a nice challenge – just like a little too much ice cream.</p>
</div>
<div class='col-lg-1'></div>
</div>
</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

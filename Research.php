<?php
@include('config.php');
session_start();
?>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SpaceTech</title>
  <link rel="stylesheet" href="css/style2.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <header>
    <?php @include('nav/header.php'); ?>
  </header>
  <section class="books">

    <?php
    $all_research = mysqli_query($conn, "SELECT * FROM `research`") or die('query failed');
    if (mysqli_num_rows($all_research) > 0) {
      echo '<div class="research-container">';
      while ($fetch_research = mysqli_fetch_assoc($all_research)) {
        ?>
        <div class="research-resch-history">
          <div class="research-inner">
            <div class="research-cover-img-resch">
              <img src="uploaded_research/uploaded_img/<?php echo $fetch_research['rs_image']; ?>" alt="research Cover">
            </div>
            <div class="research-details-text-resch">
              <h3 class="research-title">
                <?php echo $fetch_research['name']; ?>
              </h3>
              <p class="research-desciption"> <!-- Use <p> instead of <h3> for description -->
                <?php echo $fetch_research['description']; ?>
              </p>

            </div>
            <?php
            if (isset($_SESSION['userid'])) {
              echo '<a href="show_research.php?research_id=' . $fetch_research['id'] . '" class="inline-option-btn"> View </a>';
            }
            ?>
          </div>
        </div>

        <?php
      }
      echo '</div>';
    } else {
      echo '<p class="empty">No research Available</p>';
    }
    ?>

  </section>
  </center>


  <div class="button-container">
  <?php
    if (isset($_SESSION['userid'])) {
      echo '<a href="research_upload.php" name="upload_res" class="btnr"><img src="img/upload-regular-24.png" alt=""></a>';
    } else {
      echo '<a href="login.php" class="btnr"><img src="img/upload-regular-24.png" alt=""></a>';
    }
    ?>
  </div>
</body>
<?php @include('nav/footer.php'); ?>
</html>
<style>
  .research-resch-history {
    /* display: flex; */
    background-color: rgba(16, 18, 54, 0.7);
    padding: 1rem;
    color: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.7);
    margin: 1rem 0.5rem;
  }

  .research-inner {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 1rem;
    align-items: center;
    /* Center vertically */
  }

  .research-cover-img-resch img {
    width: 200px;
    height: auto;
  }

  .research-details-text-resch {
    text-align: center;
  }

  .research-subject,
  .research-title {
    font-size: 1rem;
    text-shadow: 2px 1px 1px #cd1a1a;
    margin-bottom: 0.5rem;
  }

  .research-desciption {
    line-height: 1.5rem;
  }

  .inline-option-btn {
    display: inline-block;
    margin-top: 0.5rem;
    padding: 0.3rem 1rem;
    background-color: #70efbf;
    color: #fff;
    border: none;
    border-radius: 5px;
    text-decoration: none;
  }

  .button-container {
    text-align: right;
    padding-right: 25px;
    padding-bottom: 25px;

  }

  .button-container img {
    width: 25px;
  }

  
  .button-container .btnr {
    background: linear-gradient(180deg, #70efbf 0, #21c69a 100%);
    height: 50px;
    line-height: 41px;
    border-radius: 50%;
    padding: 16px 15px;
    font-weight: 700;
    letter-spacing: 1px;
    transition: all .3s ease;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
  }

  .button-container .btnr:hover {
    background: linear-gradient(180deg, #70efbf 0, #12bd7b 100%);
    box-shadow: 0 3px 9px #25b981;
  }
</style>
<?php
  include_once('includes/functions.php');
  include_once('includes/simple_html_dom.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php $title_page = "Check YouTubers subscribers"; ?>
<?php include_once('includes/header.php'); ?>

<div class="alert off">It's seems the URL you provided is bad 🧐</div>
<?php $url_value = $_POST['url_value']; ?>
<div class="form-elag">
  <form action="" method="post" class="formAddlink">
    <div class="input-contain">
      <label>Channel URL</label>
      <input name="url_value" placeholder="https://www.youtube.com/user/caseyneistat" value="<?php echo isset($_POST['url_value']) ? $_POST['url_value'] : '' ?>">
    </div>
    <button name="submit_button">Let's go!</button>
  </form>
</div>

<?php
  if (isset($_POST['submit_button'])){
    echo('<script src="./js/jquery/formVerif.js"></script>');
  }
  else{
    echo('<!-- no input -->');
  }
?>

<?php
  // get DOM from URL or file
  $html = file_get_html($url_value);

  // get -> channel name | subs count | profile image | banner
  foreach($html->find('a.branded-page-header-title-link') as $e) 
    $channel_name = $e->innertext;
  foreach($html->find('span.yt-subscription-button-subscriber-count-branded-horizontal.subscribed.yt-uix-tooltip') as $e)
    $subs = $e->innertext;
  foreach($html->find('img.channel-header-profile-image') as $e)
    $channel_img = $e->src;
  $channel_img = str_replace("=s100", "=s500", $channel_img);
  foreach($html->find('style') as $e)
    $banner = $e->innertext;
  $banner_url_array = explode("@media screen and (-webkit-min-device-pixel-ratio: 1.5),          screen and (min-resolution: 1.5dppx) { #c4-header-bg-container {         background-image: url(//", $banner);
  $banner_url_1 = explode(");     }   }  #c4-header-bg-container .hd-banner-image {       background-image: url(//", $banner_url_array[1]);
  $banner_url = $banner_url_1[0];
  $banner_url = str_replace("w2120", "w1300", $banner_url);
?>

<div class="result">
  <div class="result-card" style="background-image:url('<?php echo("https:" . $banner_url . "") ?>')">
    <div class="result-item-container">
      <?php
        echo ('<img src="' . $channel_img . '" class="result-subs"></img>');
      ?>
      <div class="channel-meta">
      <?php
        echo ('<h2 class="result-channel_name">' . $channel_name . '</h2><h2 class="result-subs">' . $subs . '</h2>');
      ?>
      </div>
    </div>
  </div>
</div>

<?php include_once('includes/footer.php'); ?>
</body>
</html>
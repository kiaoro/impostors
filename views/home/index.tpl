<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>

<div class="content">
    <!--<h2>Home page</h2>-->
    <h3><?php print count($connections); ?> connections</h3>
    <br />
    <?php foreach ($connections as $connection) : ?>
        <div>
            <img src="<?php print $connection->pictureUrl; ?>" width="20" height="20" style="float:left;margin:5px;" />
            <div style="float:left;margin:5px;"><?php print utf8_decode($connection->firstName); ?> <?php print utf8_decode($connection->lastName); ?></div>
            <div style="float:left;margin:5px;">- <?php print (isset($connection->location->name) ? utf8_decode($connection->location->name) : ""); ?></div>

        </div>
        <div style="clear:both;"></div>
    <?php endforeach; ?>
</div>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>


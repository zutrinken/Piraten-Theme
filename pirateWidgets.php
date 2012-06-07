<?php





/**

 * PirateWidgets

 * @author Florian Bischof

 * @update Peter Amende

 */



/**

 * Pirates Everywhere

 * A link list with small images

 * @param mixed $args

 */

function piratesEverywhere($args) {

	extract($args);

	$headline = __('Piraten Überall','piraten');

	print <<<END

				<div class="widget boxPirateCommunities" id="">

					<h3 class="widget-title">{$headline}</h3>

					<div class="linklist">

						<ul>

							<li id="twitterLink"><a href="http://twitter.com/piratenberlin">Twitter</a></li>

                            <li id="identicaLink"><a href="http://identi.ca/piratenberlin">Identi.ca</a></li>

							<li id="myspaceLink"><a href="http://www.myspace.com/piratenparteiberlin">MySpace</a></li>

							<li id="youtubeLink"><a href="http://www.youtube.com/user/Piratenberlin">YouTube</a></li>

							<li id="flickrLink"><a href="http://www.flickr.com/search/?q=piratenpartei&w=all">Flickr</a></li>

							<li id="diggLink"><a href="http://digg.com/search?s=piratenpartei">Digg</a></li>

                            <li id="facebookLink"><a href="http://www.facebook.com/pages/Piratenpartei-Berlin/111078392276328">Facebook</a></li>

							<!--

							<li id="meinvzLink"><a href="#">MeinVZ</a></li>

							<li id="schuelervzLink"><a href="#">SchülerVZ</a></li>

							<li id="studivzLink"><a href="#">StudiVZ</a></li>

							<li id="werkenntwenLink"><a href="#">Wer kennt wen</a></li>

							<li id="thepiratebayLink"><a href="http://thepiratebay.org/user/Hoshpak/">The Pirate Bay</a></li>

							-->

						</ul>

					</div>

				</div>

END;

}



function piratesEverywhereControl() {



	_e('Hier gibt es nichts zu konfigurieren.','piraten');



}



wp_register_sidebar_widget('piratesEverywhere', 'Piraten Überall', 'piratesEverywhere');

wp_register_widget_control('piratesEverywhere', 'Piraten Überall', 'piratesEverywhereControl' );







/**

 * Pirate Donation Progress

 * Displays a donation progress bar

 * widget_pirate_donation_progress options:

 * - headline (default "Donation")

 * - description (default "Please donate")

 * - link (default #)

 * - currentValue (default 23)

 * - targetValue (default 42)

 * - endDate

 * @param mixed $args

 */

function pirateDonationProgress($args) {

	extract($args);

	$options = get_option('widget_pirate_donation_progress');

	$headline = ($options['headline']) ? $options['headline'] : 'Donation';

	$description = ($options['description']) ? $options['description'] : 'Please donate';

	$link = ($options['link']) ? $options['link'] : '#';

	$currentValue = ($options['currentValue']) ? $options['currentValue'] : 23;

	$targetValue = ($options['targetValue']) ? $options['targetValue'] : 42;

	$daysLeft = ($options['endDate']) ? floor((strtotime($options['endDate']) - time()) / 86400) : 42;

	$percent = floor(($currentValue / $targetValue) * 100);

	

	print <<<END

		<div id="boxDonation" class="widget">

			<h2 class="widget-title">{$headline}</h2>

			<div class="content">

				<a href="{$link}">{$description}</a>

				<div class="boxBarometer">

					<div class="progressbar"><div class="progress" style="width:{$percent}%"></div></div>

					Stand: <span class="boxBarometerCurrent">{$currentValue} €</span> von

					<span class="boxBarometerTarget">{$targetValue} €</span>. Noch <strong>{$daysLeft}</strong> Tage!

				</div>

			</div>

                        <div id=sidebtn>

                                <center><a href="http://berlin.piratenpartei.de/partei/impressum/spenden">jetzt spenden...</a></center>

                        </div>

		</div>	

END;



}



function pirateDonationProgressControl() {

	$options = $newoptions = get_option('widget_pirate_donation_progress');



	if ( isset($_POST['pirateDonationProgress-submit']) ) {

		$newoptions['headline'] = strip_tags(stripslashes($_POST['pirateDonationProgressHeadline']));

		$newoptions['description'] = strip_tags(stripslashes($_POST['pirateDonationProgressDescription']));

		$newoptions['link'] = strip_tags(stripslashes($_POST['pirateDonationProgressLink']));

		$newoptions['currentValue'] = strip_tags(stripslashes($_POST['pirateDonationProgressCurrentValue']));

		$newoptions['targetValue'] = strip_tags(stripslashes($_POST['pirateDonationProgressTargetValue']));

		$newoptions['endDate'] = strip_tags(stripslashes($_POST['pirateDonationProgressEndDate']));

	}



	if ( $options != $newoptions ) {

		$options = $newoptions;

		update_option('widget_pirate_donation_progress', $options);

	}



	$headline =  attribute_escape( $options['headline'] );

	$description =  attribute_escape( $options['description'] );

	$link =  attribute_escape( $options['link'] );	

	$currentValue = attribute_escape( $options['currentValue'] );

	$targetValue = attribute_escape( $options['targetValue'] );

	$endDate = attribute_escape( $options['endDate'] );



?>

	<p><label for="pirateDonationProgressHeadline">

	Headline: <input type="text" class="widefat" id="pirateDonationProgressHeadline" name="pirateDonationProgressHeadline" value="<?php echo $headline ?>" /></label>

	</p>

	<p><label for="pirateDonationProgressDescription">

	Description: <input type="text" class="widefat" id="pirateDonationProgressDescription" name="pirateDonationProgressDescription" value="<?php echo $description ?>" /></label>

	</p>

	<p><label for="pirateDonationProgressLink">

	Link: <input type="text" class="widefat" id="pirateDonationProgressLink" name="pirateDonationProgressLink" value="<?php echo $link ?>" /></label>

	</p>

	<p><label for="pirateDonationProgressCurrentValue">

	Aktueller Stand: <input type="text" class="widefat" id="pirateDonationProgressCurrentValue" name="pirateDonationProgressCurrentValue" value="<?php echo $currentValue ?>" /></label>

	</p>

	<p><label for="pirateDonationProgressTargetValue">

	Ziel: <input type="text" class="widefat" id="pirateDonationProgressTargetValue" name="pirateDonationProgressTargetValue" value="<?php echo $targetValue ?>" /></label>

	</p>

	<p><label for="pirateDonationProgressEndDate">

	Deadline: <input type="text" class="widefat" id="pirateDonationProgressEndDate" name="pirateDonationProgressEndDate" value="<?php echo $endDate ?>" /></label>

	</p>

	<input type="hidden" name="pirateDonationProgress-submit" id="pirateDonationProgress-submit" value="1" />

<?php

}

wp_register_sidebar_widget('pirateDonationProgress', 'Piraten Spendensammlungs Fortschritt', 'pirateDonationProgress');

wp_register_widget_control('pirateDonationProgress', 'Piraten Spendensammlungs Fortschritt', 'pirateDonationProgressControl' );









/**

 * Pirate Collection Progress

 * Displays a collection progress bar

 * widget_pirate_collection_progress options:

 * - currentValue (default 23)

 * - targetValue (default 42)

 * - endDate

 * @param mixed $args

 */

function pirateCollectionProgress($args) {

	extract($args);

	$options = get_option('widget_pirate_collection_progress');

	$title = ($options['title']);

	$link = ($options['link']);

	$currentValue = ($options['currentValue']) ? $options['currentValue'] : 23;

	$targetValue = ($options['targetValue']) ? $options['targetValue'] : 42;

	$daysLeft = ($options['endDate']) ? floor((strtotime($options['endDate']) - time()) / 86400) : 42;

	$percent = floor(($currentValue / $targetValue) * 100);

		

	print <<<END

		<div id="boxVote" class="widget">

			<h2 class="widget-title">{$title}</h2>

			<div class="content">

				<a href="{$link}">Unterstüte uns mit deiner Unterschrift!</a>

				<div class="boxBarometer">

					<div class="progressbar"><div class="progress" style="width:{$percent}%"></div></div>

					Stand: <span class="boxBarometerCurrent">{$currentValue}</span> von

					<span class="boxBarometerTarget">{$targetValue}</span>. Noch <strong>{$daysLeft}</strong> Tage!

				</div>

			</div>

		</div>	

END;

}



function pirateCollectionProgressControl() {

	$options = $newoptions = get_option('widget_pirate_collection_progress');



	if ( isset($_POST['pirateCollectionProgress-submit']) ) {

		$newoptions['currentValue'] = strip_tags(stripslashes($_POST['pirateCollectionProgressCurrentValue']));

		$newoptions['targetValue'] = strip_tags(stripslashes($_POST['pirateCollectionProgressTargetValue']));

		$newoptions['endDate'] = strip_tags(stripslashes($_POST['pirateCollectionProgressEndDate']));

		$newoptions['title'] = strip_tags(stripslashes($_POST['pirateCollectionProgressTitle']));

		$newoptions['link'] = strip_tags(stripslashes($_POST['pirateCollectionProgressLink']));

	}



	if ( $options != $newoptions ) {

		$options = $newoptions;

		update_option('widget_pirate_collection_progress', $options);

	}



	$currentValue = attribute_escape( $options['currentValue'] );

	$targetValue = attribute_escape( $options['targetValue'] );

	$endDate = attribute_escape( $options['endDate'] );

	$title = attribute_escape( $options['title'] );

	$link = attribute_escape( $options['link'] );

?>

	<p><label for="pirateCollectionProgressTitle">

        Titel: <input type="text" class="widefat" id="pirateCollectionProgressTitle" name="pirateCollectionProgressTitle" value="<?php echo $title ?>" /></label>

        </p>



	<p><label for="pirateCollectionProgressLink">

        Unterschriftenlink: <input type="text" class="widefat" id="pirateCollectionProgressLink" name="pirateCollectionProgressLink" value="<?php echo $link ?>" /></label>

        </p>



	<p><label for="pirateCollectionProgressCurrentValue">

	Aktueller Stand: <input type="text" class="widefat" id="pirateCollectionProgressCurrentValue" name="pirateCollectionProgressCurrentValue" value="<?php echo $currentValue ?>" /></label>

	</p>

	<p><label for="pirateCollectionProgressTargetValue">

	Ziel: <input type="text" class="widefat" id="pirateCollectionProgressTargetValue" name="pirateCollectionProgressTargetValue" value="<?php echo $targetValue ?>" /></label>

	</p>

	<p><label for="pirateCollectionProgressEndDate">

	Deadline: <input type="text" class="widefat" id="pirateCollectionProgressEndDate" name="pirateCollectionProgressEndDate" value="<?php echo $endDate ?>" /></label>

	</p>

	<input type="hidden" name="pirateCollectionProgress-submit" id="pirateCollectionProgress-submit" value="1" />

<?php

}

wp_register_sidebar_widget('pirateCollectionProgress', 'Piraten Sammlungs Fortschritt', 'pirateCollectionProgress');

wp_register_widget_control('pirateCollectionProgress', 'Piraten Sammlungs Fortschritt', 'pirateCollectionProgressControl' );









/**

 * Pirate SMS

 * @param mixed $args

 */

function pirateWidgetSms($args) {

	extract($args);

	$options = get_option('widget_pirate_sms');



	echo '<div class="widget info" id="boxBecomePirateSms">';

	echo '<a href="#"><strong>Werde SMS Pirat!</strong><span>Sende <q>PIRAT</q> an 0163 7774728</span></a>';

	echo '</div>';



}



function pirateWidgetSmsControl() {

	$options = $newoptions = get_option('widget_pirate_sms');



	if ( isset($_POST['tag-cloud-submit']) ) {

		$newoptions['title'] = strip_tags(stripslashes($_POST['tag-cloud-title']));

	}



	if ( $options != $newoptions ) {

		$options = $newoptions;

		update_option('widget_pirate_sms', $options);

	}



	$title = attribute_escape( $options['title'] );

?>

	<p><label for="smsPiratTitle">

	<?php _e('Title:') ?> <input type="text" class="widefat" id="smsPiratTitle" name="smsPiratTitle" value="<?php echo $title ?>" /></label>

	</p>

	<input type="hidden" name="smsPiratSubmit" id="smsPiratSubmit" value="1" />

<?php

}
wp_register_sidebar_widget('pirateSms', 'SMS Pirat', 'pirateWidgetSms');
wp_register_widget_control('pirateSms', 'SMS Pirat', 'pirateWidgetSmsControl' );
?>
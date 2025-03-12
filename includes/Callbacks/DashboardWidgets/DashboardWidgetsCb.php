<?php

namespace BwlFaqManager\Callbacks\DashboardWidgets;

use BwlFaqManager\Controllers\Analytics\BafAnalyticsSummary;
use BwlFaqManager\Controllers\Analytics\BafAnalyticsLikesCount;
use BwlFaqManager\Controllers\Analytics\BafAnalyticsViewsCount;

/**
 * @package BwlFaqManager
 */

class DashboardWidgetsCb {

	public function __construct() {
	}

	public function getPluginSummary() {

		$bafAnalyticsSummaryData = new BafAnalyticsSummary();

		// Get All The FAQ Summary Data. (Total FAQs, Total Categories and Topics)
		$bafSummaryData = $bafAnalyticsSummaryData->register();

		$bafAnalyticsLikesCountData = new BafAnalyticsLikesCount();
		$faqLikesCount              = $bafAnalyticsLikesCountData->register();

		$bafAnalyticsViewsCountData = new BafAnalyticsViewsCount();
		$faqViewsCount              = $bafAnalyticsViewsCountData->register();

		// $totalFaqs = $bafSummaryData['totalFaqs']['published'] + $bafSummaryData['totalFaqs']['pending'];
		$totalFaqsPublished = $bafSummaryData['totalFaqs']['published'];
		// $totalFaqsPending = $bafSummaryData['totalFaqs']['pending'];
		// $totalFaqsDraft = $bafSummaryData['totalFaqs']['draft'];

		ob_start();
		?>


<div class="baf-plugin-summary-dash-widget">

    <ul class="items-container">
    <li class="item">
        <span class="dashicons dashicons-analytics"></span>
        <span class="count"><?php echo $totalFaqsPublished; ?></span>
        <span class="title">FAQ Posts</span>
    </li>

    <li class="item">
        <span class="dashicons dashicons-index-card"></span>
        <span class="count"><?php echo $bafSummaryData['totalCategories']; ?></span>
        <span class="title text text-primary">FAQ Categories</span>
    </li>

    <li class="item">
        <span class="dashicons dashicons-tag"></span>
        <span class="count"><?php echo $bafSummaryData['totalTopics']; ?></span>
        <span class="title">FAQ Topics</span>
    </li>

    <li class="item">
        <span class="dashicons dashicons-thumbs-up"></span>
        <span class="count"><?php echo $faqLikesCount['totalLikes']; ?></span>
        <span class="title">FAQ Likes</span>
    </li>

    <li class="item">
        <span class="dashicons dashicons-visibility"></span>
        <span class="count"><?php echo $faqViewsCount['totalViews']; ?></span>
        <span class="title">FAQ Views</span>
    </li>

    <li class="item">
        <a class="button button-primary" href="
        <?php
		echo admin_url('edit.php?post_type=bwl_advanced_faq&page=bwl-advanced-faq-analytics
')
		?>
                                                ">FAQ Analytics</a>
    </li>

    </ul>


</div>


		<?php

		echo ob_get_clean();
	}
}

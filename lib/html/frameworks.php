<?php
function thesis_html_framework() {
	global $thesis_design;
	echo apply_filters('thesis_doctype', '<!DOCTYPE html>') . "\n";
?>
<html <?php language_attributes(); ?>>
<?php
	thesis_head::build();
	echo "<body" . thesis_body_classes() . ">\n"; #filter
	thesis_hook_before_html(); #hook
	
	if ($thesis_design->layout['framework'] == 'page')
		thesis_framework_page();
	elseif ($thesis_design->layout['framework'] == 'full-width')
		thesis_framework_full_width();
	else
		thesis_framework_page();

	thesis_ie_clear();
	thesis_javascript::output_scripts();
	thesis_hook_after_html(); #hook
	echo "</body>\n</html>";
}

function thesis_framework_page() {
	echo "<div id=\"container\">\n";
	echo "<div id=\"page\">\n";

	if (apply_filters('thesis_show_header', true)) thesis_header_area();
	thesis_content_area();
	if (apply_filters('thesis_show_footer', true)) thesis_footer_area();

	echo "</div>\n";
	echo "</div>\n";
}

function thesis_framework_full_width() {
	if (apply_filters('thesis_show_header', true)) thesis_wrap_header();
	thesis_wrap_content();
	if (apply_filters('thesis_show_footer', true)) thesis_wrap_footer();
}

function thesis_wrap_header() {
	echo "<div id=\"header_area\" class=\"full_width\">\n";
	echo "<div class=\"page\">\n";

	thesis_header_area();

	echo "</div>\n";
	echo "</div>\n";
}

function thesis_wrap_content() {
	thesis_hook_before_content_area(); #hook

	echo "<div id=\"content_area\" class=\"full_width\">\n";
	echo "<div class=\"page\">\n";

	thesis_content_area();

	echo "</div>\n";
	echo "</div>\n";

	thesis_hook_after_content_area(); #hook
}

function thesis_wrap_footer() {
	echo "<div id=\"footer_area\" class=\"full_width\">\n";
	echo "<div class=\"page\">\n";
	
	thesis_footer_area();
	
	echo "</div>\n";
	echo "</div>\n";
}

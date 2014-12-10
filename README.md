# Castlegate IT WP CMB SEO #

Simple SEO fields for titles, headings, and descriptions. The title and description fields (`seo_title` and `seo_description`) are displayed automatically. The heading `seo_heading` must be added the (child) theme template manually. You can do this with `get_field('seo_heading')` or `get_post_meta($post->ID, 'seo_heading', TRUE)`. Use the `cgit_seo_fields` filter to edit the SEO fields (e.g. to add support for custom post types). Requires the [Human Made Custom Meta Boxes plugin](https://github.com/humanmade/Custom-Meta-Boxes).

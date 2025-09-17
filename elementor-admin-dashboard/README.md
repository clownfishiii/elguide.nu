# Elementor Admin Dashboard

This plugin adds a customizable admin-style dashboard widget that can be edited visually with **Elementor Pro**. Use it to build client-facing control centers, intranet dashboards, or reporting pages that surface real-time WordPress metrics together with your own quick links.

## Features

- Elementor widget that exposes WordPress statistics (posts, pages, comments, users).
- Repeater control to add custom quick links for popular admin destinations or external tools.
- Responsive card layout with style controls for colors, typography, spacing, borders, and shadows.
- Optional custom post type for saving multiple dashboard layouts and sharing them with different users.
- Ready-to-use styling that looks great out of the box but can be fully adjusted in Elementor Pro.

## Requirements

- WordPress 6.0+
- PHP 7.4+
- [Elementor](https://elementor.com/) 3.0 or higher (Elementor Pro recommended for Theme Builder templates).

## Installation

1. Ensure the plugin directory is structured exactly as:
   ```
   elementor-admin-dashboard/
   ├── elementor-admin-dashboard.php
   ├── assets/
   └── includes/
   ```
2. Compress the `elementor-admin-dashboard` folder into a ZIP archive so the archive root contains that folder directly.
3. In WordPress, navigate to **Plugins → Add New → Upload Plugin**, choose the ZIP, and install.
4. Activate **Elementor Admin Dashboard** and make sure Elementor (and Elementor Pro if you use Theme Builder) is active.

## Creating a Dashboard in Elementor

1. Create a new page (or template) and open it with Elementor.
2. Search for **Admin Dashboard** in the Elementor widget panel.
3. Drag the widget onto the canvas. Real WordPress stats are loaded automatically.
4. Configure the widget settings:
   - Toggle which metrics to display.
   - Choose between the "Cards" or "Minimal" layout.
   - Adjust the column count for the metric cards.
   - Add custom quick links with labels and URLs (internal or external).
5. Use the **Style** tab to edit typography, colors, paddings, borders, and shadows so the dashboard matches your branding.
6. Publish the page. You can optionally restrict access with your favorite membership or user-role plugin.

## Saving Dashboards as Templates

The plugin registers a custom post type **Admin Dashboards** under the WordPress admin menu. You can use this post type to save dashboard layouts, attach featured images, or collaborate with other editors. Pair it with Elementor Theme Builder templates or shortcodes for advanced workflows.

## Developer Notes

- Metrics can be filtered via the `elementor_admin_dashboard_metrics` filter.
- CSS is enqueued in the Elementor editor and on the frontend when the widget renders.
- The plugin is namespaced with the `Elementor_Admin_Dashboard_` prefix to avoid conflicts.

## Support

This plugin is provided as-is. For feature requests or issues please open a ticket in your preferred project management tool or contact the development team behind elguide.nu.

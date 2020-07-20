<?php

namespace jeyofdev\wp\yoga\ahana\options;



/**
 * Class that manages the club panel in the administration settings
 */
class ClubSettings
{
    CONST GROUP = "club_settings";
    CONST SECTION_SLUG = "club_settings_section";

    CONST ADDRESS = "club_address";
    CONST CITY = "club_city";
    CONST PHONE_CODE = "club_phone_code";
    CONST PHONE = "club_phone";
    CONST OPENING_HOURS = "club_opening_hours";

    CONST WEEK_OPENING = "club_week_opening";
    CONST SATURDAY_OPENING = "club_saturday_opening";
    CONST SUNDAY_OPENING = "club_sunday_opening";

    CONST WEEK_CLOSING = "club_week_closing";
    CONST SATURDAY_CLOSING = "club_saturday_closing";
    CONST SUNDAY_CLOSING = "club_sunday_closing";



    /**
     * Save a new item to the admin panel
     */
    public static function register () : void
    {
        add_action("admin_menu", [self::class, "addmenu"]);
        add_action("admin_init", [self::class, "registerSettings"]);
    }



    /**
     * Create the form that manages the options
     */
    public static function registerSettings () : void
    {
        register_setting(self::GROUP, self::ADDRESS);
        register_setting(self::GROUP, self::CITY);
        register_setting(self::GROUP, self::PHONE_CODE);
        register_setting(self::GROUP, self::PHONE);
        register_setting(self::GROUP, self::OPENING_HOURS);

        register_setting(self::GROUP, self::WEEK_OPENING);
        register_setting(self::GROUP, self::SATURDAY_OPENING);
        register_setting(self::GROUP, self::SUNDAY_OPENING);

        register_setting(self::GROUP, self::WEEK_CLOSING);
        register_setting(self::GROUP, self::SATURDAY_CLOSING);
        register_setting(self::GROUP, self::SUNDAY_CLOSING);

        add_settings_section(self::SECTION_SLUG, null, null, self::GROUP);

        add_settings_field("club_options_phone_code", __("Phone code", "ahana"), function () {
            $phone_code = [];
            for ($i = 1; $i<=1876; $i++) { 
                $phone_code[$i] = "(+$i)";
            }

            $options = [];
            foreach ($phone_code as $key => $value) {
                $codeVerif = "code-$key";
                $selected = '';
                if ($codeVerif === get_option(self::PHONE_CODE)) {
                    $selected = " selected";
                }
                $options[] = '<option value="code-' . $key . '"' . $selected . '>' . $value . '</option>';
            }

            ?>
                <select name="<?= self::PHONE_CODE; ?>" id="<?= self::PHONE_CODE; ?>" class="regular-text">
                    <?= implode("\n", $options); ?>
                </select>
                <p class="description" id="phone_code-description"><?= __("Phone code (ex: France: +33, United States : +1).", "ahana"); ?></p>
            <?php
        }, self::GROUP, self::SECTION_SLUG);

        add_settings_field("club_options_phone", __("Phone", "ahana"), function () {
            ?>
                <input type="text" name="<?= self::PHONE; ?>" id="<?= self::PHONE; ?>" class="regular-text" value="<?= esc_html(get_option(self::PHONE)); ?>">
                <p class="description" id="phone-description"><?= __("Club phone number (ex: 01 12 34 56 78).", "ahana"); ?></p>
            <?php
        }, self::GROUP, self::SECTION_SLUG);

        add_settings_field("club_options_address", __("Address", "ahana"), function () {
            ?>
                <input type="text" name="<?= self::ADDRESS; ?>" id="<?= self::ADDRESS; ?>" class="regular-text" value="<?= esc_html(get_option(self::ADDRESS)); ?>">
                <p class="description" id="address-description"><?= __("Club address (ex: 184 Main Collins Street).", "ahana"); ?></p>
            <?php
        }, self::GROUP, self::SECTION_SLUG);

        add_settings_field("club_options_city", __("City", "ahana"), function () {
            ?>
                <input type="text" name="<?= self::CITY; ?>" id="<?= self::CITY; ?>" class="regular-text" value="<?= esc_html(get_option(self::CITY)); ?>">
                <p class="description" id="address-description"><?= __("Club address city (ex: Paris, New York).", "ahana"); ?></p>
            <?php
        }, self::GROUP, self::SECTION_SLUG);

        add_settings_field("club_options_opening_hours", __("Opening hours", "ahana"), function () {
            $days = [
                "week" => __("From Monday to Friday", "ahana"), 
                "saturday" => __("Saturday", "ahana"), 
                "sunday" => __("Sunday", "ahana")
            ];

            $opening_hours = [
                "week_opening", "saturday_opening", "sunday_opening",
                "week_closing", "saturday_closing", "sunday_closing",
            ];

            $hours = [];
            for ($i = 0; $i<=23; $i++) {
                $hours[] = $i . "h";
                $hours[] = $i . "h30";
            }

            foreach($days as $day_k => $day_v) {
                echo '<span>';
                echo '<span class="opening-hours-subtitle">' . $day_v . ' :</span>';

                foreach ($opening_hours as $value) {

                    if (strpos($value, $day_k) !== false) {

                        $options = [];
                        foreach($hours as $hour_k => $hour_v) {

                            $selected = '';
                            if ((string)$hour_v === (string)get_option(constant("self::" . strtoupper($value)))) {
                                $selected = " selected";
                            }

                            $options[] = '<option value="' . $hour_v . '" ' . $selected . '>' . $hour_v . '</option>';
                        }

                        $name = "club_" . $value;
                        ?>

                        <select name="<?= $name; ?>" id="<?= $name; ?>">
                            <?= implode("\n", $options); ?>
                        </select>
                    <?php
                    }
                }

                echo "</span>";
            }
        }, self::GROUP, self::SECTION_SLUG);
    }



    /**
     * Add submenu club to the Settings main menu
     *
     * @return void
     */
    public static function addmenu () : void
    {
        add_options_page(
            __("Club Settings", "ahana"),
            __("Club", "ahana"),
            "manage_options",
            self::GROUP,
            [self::class, "render"]
        );
    }



    /**
     * Display the informations
     *
     * @return void
     */
    public static function render () : void
    {
        ?>
        <div class="wrap">
            <h1><?= __("Club Settings", "ahana"); ?></h1>
        </div>

        <form action="options.php" method="post">
            <?php settings_fields(self::GROUP); ?>
            <?php do_settings_sections(self::GROUP); ?>
            <?php submit_button(); ?>
        </form>

        <?php 
    }
}

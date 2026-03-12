<?php
if (!defined('ABSPATH')) exit;

class MCEMS_Bookings_List_Base {

    public static function init(): void {
        add_shortcode('mcems_bookings_list', [__CLASS__, 'shortcode']);
        add_shortcode('mcems_exam_bookings_list', [__CLASS__, 'shortcode']);
    }

    private static function can_view(): bool {
        $cap = MCEMS_Settings::get_str('cap_view_bookings');
        if (!$cap) $cap = 'manage_options';
        return current_user_can($cap) || current_user_can('manage_options');
    }

    private static function badge_special(bool $is_special): string {
        if ($is_special) {
            return '<span style="display:inline-flex;align-items:center;gap:6px;padding:4px 10px;border-radius:999px;background:#e8f0fe;color:#1a73e8;font-weight:800;font-size:12px;">♿ Yes</span>';
        }
        return '<span style="color:#98a2b3;">—</span>';
    }

    public static function shortcode(): string {
        if (!is_user_logged_in()) return '<p>You must be logged in.</p>';
        if (!self::can_view()) return '<p>Insufficient permissions.</p>';

        $courses = MCEMS_Tutor::get_courses();
        $course_pt = MCEMS_Tutor::course_post_type();

        $selected_date = isset($_GET['mcems_date']) ? sanitize_text_field($_GET['mcems_date']) : '';
        $selected_course = isset($_GET['mcems_course']) ? (int) $_GET['mcems_course'] : 0;

        // Force "show only after selecting a date"
        $has_date = (bool) preg_match('/^\d{4}-\d{2}-\d{2}$/', $selected_date);

        ob_start();
        ?>
        <style>
            .mcems-adminwrap{max-width:1200px;margin:0 auto;}
            .mcems-panel{background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:16px;box-shadow:0 1px 2px rgba(16,24,40,.06);}
            .mcems-title{margin:0 0 6px;font-size:1.2rem;font-weight:900;}
            .mcems-desc{margin:0 0 14px;color:#667085;}
            .mcems-filters{display:flex;flex-wrap:wrap;gap:10px;align-items:end;}
            .mcems-field{display:flex;flex-direction:column;gap:6px;}
            .mcems-field label{font-size:12px;font-weight:800;color:#344054;}
            .mcems-field input,.mcems-field select{min-width:240px;padding:9px 10px;border-radius:12px;border:1px solid #d0d5dd;background:#fff;}
            .mcems-actions{display:flex;gap:10px;align-items:center;}
            .mcems-btn{appearance:none;border:1px solid #d0d5dd;background:#101828;color:#fff;border-radius:12px;padding:10px 14px;font-weight:900;cursor:pointer;}
            .mcems-btn:hover{filter:brightness(1.05);}
            .mcems-link{font-weight:800;color:#344054;text-decoration:none;border:1px solid #d0d5dd;border-radius:12px;padding:10px 14px;background:#fff;}
            .mcems-link:hover{background:#f9fafb;}
            .mcems-hint{margin-top:10px;color:#667085;font-size:12px;}
            .mcems-tablewrap{margin-top:14px;overflow:auto;}
            table.mcems-table{min-width:1100px;border-collapse:separate;border-spacing:0;overflow:hidden;border:1px solid #e5e7eb;border-radius:14px;}
            table.mcems-table thead th{background:#f9fafb;color:#344054;font-weight:900;font-size:12px;text-transform:uppercase;letter-spacing:.02em;padding:10px;border-bottom:1px solid #e5e7eb;}
            table.mcems-table tbody td{padding:10px;border-bottom:1px solid #f2f4f7;vertical-align:top;}
            table.mcems-table tbody tr:hover td{background:#fcfcfd;}
            .mcems-empty{margin-top:12px;padding:12px;border:1px dashed #d0d5dd;border-radius:14px;color:#667085;background:#fcfcfd;}
            .mcems-pill{display:inline-flex;align-items:center;gap:8px;padding:6px 10px;border-radius:999px;background:#f2f4f7;color:#344054;font-size:12px;font-weight:800;}
        </style>

        <div class="mcems-adminwrap">
            <div class="mcems-panel">
                <h3 class="mcems-title">Bookings list</h3>
                <p class="mcems-desc">Select a <strong>date</strong> to view bookings. You can also filter by course.</p>

                <form method="get" class="mcems-filters">
                    <input type="hidden" name="post_type" value="<?php echo esc_attr(MCEMS_CPT_Sessioni_Esame::CPT); ?>">
                    <?php
                    // Preserve "page" if inside admin, but shortcode may be used anywhere.
                    if (isset($_GET['page'])) {
                        echo '<input type="hidden" name="page" value="' . esc_attr(sanitize_text_field($_GET['page'])) . '">';
                    }
                    ?>

                    <div class="mcems-field">
                        <label for="mcems_date">Date</label>
                        <input type="date" id="mcems_date" name="mcems_date" value="<?php echo esc_attr($has_date ? $selected_date : ''); ?>" required>
                    </div>

                    <div class="mcems-field">
                        <label for="mcems_course">Course</label>
                        <select id="mcems_course" name="mcems_course">
                            <option value="0">All courses</option>
                            <?php if ($course_pt && $courses): foreach ($courses as $cid => $title): ?>
                                <option value="<?php echo (int)$cid; ?>" <?php selected($selected_course, (int)$cid); ?>>
                                    <?php echo esc_html($title); ?>
                                </option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>

                    <div class="mcems-actions">
                        <button class="mcems-btn" type="submit">Filter</button>
                        <a class="mcems-link" href="<?php echo esc_url(remove_query_arg(['mcems_date','mcems_course'])); ?>">Reset</a>
                    </div>
                </form>

                <?php if (!$has_date): ?>
                    <div class="mcems-empty">📌 Select a date and click <strong>Filter</strong> to view the bookings list.</div>
                <?php else: ?>

                    <?php
                    // Query sessions for that date (and optional course)
                    $meta = [
                        [
                            'key'     => MCEMS_CPT_Sessioni_Esame::MK_DATE,
                            'value'   => $selected_date,
                            'compare' => '=',
                        ],
                    ];
                    if ($selected_course > 0) {
                        $meta[] = [
                            'key'     => MCEMS_CPT_Sessioni_Esame::MK_COURSE_ID,
                            'value'   => $selected_course,
                            'compare' => '=',
                        ];
                    }

                    $session_ids = get_posts([
                        'post_type'      => MCEMS_CPT_Sessioni_Esame::CPT,
                        'post_status'    => 'publish',
                        'posts_per_page' => -1,
                        'fields'         => 'ids',
                        'meta_query'     => $meta,
                        'orderby'        => 'meta_value',
                        'meta_key'       => MCEMS_CPT_Sessioni_Esame::MK_TIME,
                        'order'          => 'ASC',
                    ]);

                    $rows = [];
                    foreach ($session_ids as $sid) {
                        $sid = (int) $sid;
                        $date = (string) get_post_meta($sid, MCEMS_CPT_Sessioni_Esame::MK_DATE, true);
                        $time = (string) get_post_meta($sid, MCEMS_CPT_Sessioni_Esame::MK_TIME, true);
                        $course_id = (int) get_post_meta($sid, MCEMS_CPT_Sessioni_Esame::MK_COURSE_ID, true);

                        $occ = get_post_meta($sid, MCEMS_CPT_Sessioni_Esame::MK_OCCUPATI, true);
                        if (!is_array($occ) || empty($occ)) continue;

                        $is_special = ((int) get_post_meta($sid, MCEMS_CPT_Sessioni_Esame::MK_IS_SPECIAL, true) === 1);

                        $proctor_id = (int) get_post_meta($sid, MCEMS_CPT_Sessioni_Esame::MK_PROCTOR_USER_ID, true);
                        $proctor = $proctor_id ? get_user_by('id', $proctor_id) : null;
                        $proctor_label = $proctor ? $proctor->display_name : '—';

                        foreach ($occ as $uid) {
                            $uid = (int) $uid;
                            $u = get_user_by('id', $uid);
                            if (!$u) continue;

                            $fn = trim((string) get_user_meta($uid, 'first_name', true));
                            $ln = trim((string) get_user_meta($uid, 'last_name', true));
                            if ($fn === '' && $ln === '') $fn = $u->display_name;

                            $rows[] = [
                                'cognome' => $ln,
                                'nome'    => $fn,
                                'email'   => $u->user_email,
                                'data'    => $date,
                                'ora'     => $time,
                                'corso'   => $course_id,
                                'special' => $is_special,
                                'proctor' => $proctor_label,
                            ];
                        }
                    }

                    usort($rows, function($a,$b){
                        $ka = ($a['data'] ?? '').' '.($a['ora'] ?? '');
                        $kb = ($b['data'] ?? '').' '.($b['ora'] ?? '');
                        if ($ka === $kb) return strcmp(($a['cognome'] ?? ''), ($b['cognome'] ?? ''));
                        return strcmp($ka, $kb);
                    });

                    $date_h = date_i18n('d/m/Y', strtotime($selected_date));
                    ?>
                    <div class="mcems-hint">
                        <span class="mcems-pill">📅 Date: <strong><?php echo esc_html($date_h); ?></strong></span>
                        <?php if ($selected_course > 0): ?>
                            <span class="mcems-pill">📘 Course: <strong><?php echo esc_html(MCEMS_Tutor::course_title($selected_course)); ?></strong></span>
                        <?php else: ?>
                            <span class="mcems-pill">📘 Course: <strong>All</strong></span>
                        <?php endif; ?>
                        <span class="mcems-pill">👥 Bookings: <strong><?php echo (int) count($rows); ?></strong></span>
                    </div>

                    <div class="mcems-tablewrap">
                        <table class="mcems-table">
                            <thead>
                                <tr>
                                    <th>Last name</th>
                                    <th>First name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Course</th>
                                    <th>♿</th>
                                    <th>Proctor</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!$rows): ?>
                                <tr><td colspan="8" style="text-align:center;color:#667085;padding:14px;">No exam bookings found for these filters.</td></tr>
                            <?php else: foreach ($rows as $r): ?>
                                <tr>
                                    <td><?php echo esc_html($r['cognome']); ?></td>
                                    <td><?php echo esc_html($r['nome']); ?></td>
                                    <td><?php echo esc_html($r['email']); ?></td>
                                    <td><?php echo esc_html( date_i18n('d/m/Y', strtotime($r['data'])) ); ?></td>
                                    <td><?php echo esc_html($r['ora']); ?></td>
                                    <td><?php echo esc_html(MCEMS_Tutor::course_title((int)$r['corso'])); ?></td>
                                    <td><?php echo self::badge_special(!empty($r['special'])); ?></td>
                                    <td><?php echo esc_html($r['proctor']); ?></td>
                                </tr>
                            <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

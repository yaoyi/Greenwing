<div class="project-header <?= $filters['plugin'] && gettype($filters['plugin']) == 'array' ? 'color-' : '' ?><?= $filters['plugin'] && gettype($filters['plugin']) == 'array' ? $filters['plugin']['task']['color_id'] : '' ?>">
    <?php $filters['plugin'] = '' ?>

    <?= $this->hook->render('template:project:header:before', array('project' => $project)) ?>

    <div class="dropdown-component">
        <?= $this->render('project_header/dropdown', array('project' => $project, 'board_view' => $board_view)) ?>
    </div>
    <div class="views-switcher-component">
        <?= $this->render('project_header/views', array('project' => $project, 'filters' => $filters)) ?>
    </div>
    <?php if (strpos($_SERVER["QUERY_STRING"], 'TaskViewController') === false): ?>
        <div class="filter-box-component">
            <?= $this->render('project_header/search', array(
                'project' => $project,
                'filters' => $filters,
                'custom_filters_list' => isset($custom_filters_list) ? $custom_filters_list : array(),
                'users_list' => isset($users_list) ? $users_list : array(),
                'colors_list' => isset($colors_list) ? $colors_list : array(),
                'categories_list' => isset($categories_list) ? $categories_list : array(),
                'tags_list' => isset($tags_list) ? $tags_list : array(),
            )) ?>
        </div>
    <?php endif ?>
    <?= $this->hook->render('template:project:header:after', array('project' => $project)) ?>
</div>

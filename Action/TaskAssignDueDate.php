<?php
namespace Kanboard\Plugin\Greenwing\Action;
use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;
/**
 * Assign a color to a task
 *
 * @package Kanboard\Action
 * @author  Jacob Charles Wilson
 */
class TaskAssignDueDate extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Assign a due date base on start date and hours estimated');
    }
    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_CREATE_UPDATE,
        );
    }
    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
      return array();
    }
    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
      return array();
    }
    /**
     * Execute the action (set the task due date)
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $values = array(
            'id' => $data['task_id'],
            'date_due' => strtotime('+'.$data['task']['time_estimated'].'hours', $data['task']['date_started']),
        );
        return $this->taskModificationModel->update($values, false);
    }
    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
      return empty($data['task']['date_due']) && ! empty($data['task']['date_started']) && ! empty($data['task']['time_estimated']);
    }
}

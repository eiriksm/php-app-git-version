<?php

namespace eiriksm\GitInfo;

use pastuhov\Command\Command;

/**
 * Class GitInfo.
 */
class GitInfo implements GitInfoInterface {

  /**
   * The git command.
   *
   * @var string
   */
  private $gitCommand;

  /**
   * Constructor.
   */
  public function __construct($git_command = 'git') {
    $this->gitCommand = $git_command;
  }

  /**
   * {@inheritdoc}
   */
  public function getShortHash() {
    return $this->execAndTrim('log --pretty="%h" -n1 HEAD');
  }

  /**
   * {@inheritdoc}
   */
  public function getVersion() {
    $tag = $this->execAndTrim('describe --tags');
    return !empty($tag) ? $tag : 'dev';
  }

  /**
   * {@inheritdoc}
   */
  public function getDate() {
    if (!$date = $this->execAndTrim('log -n1 --pretty=%ci HEAD')) {
      return FALSE;
    }
    $commit_date = new \DateTime($date);
    $commit_date->setTimezone(new \DateTimeZone('UTC'));
    return $commit_date->format('Y-m-d H:m:s');
  }

  /**
   * Helper to make sure we trim the output.
   *
   * @param string $command
   *   The command to run.
   *
   * @return string|bool
   *   The output string, or FALSE if things went badly.
   */
  protected function execAndTrim($command) {
    try {
      $result = Command::exec($this->gitCommand . ' ' . $command, []);
    }
    catch (\Exception $e) {
      $result = FALSE;
    }
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function getApplicationVersionString() {
    $date = $this->getDate();
    $date_string = '';
    if ($date) {
      $date_string = " ($date)";
    }
    return sprintf('v.%s.%s%s', $this->getVersion(), $this->getShortHash(), $date_string);
  }

}

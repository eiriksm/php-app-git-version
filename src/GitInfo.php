<?php

namespace eiriksm\GitInfo;

use Symfony\Component\Process\Process;

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
    return $this->execAndTrim(['log', '--pretty=%h', '-n1', 'HEAD']);
  }

  /**
   * {@inheritdoc}
   */
  public function getVersion() {
    $tag = $this->execAndTrim(['describe', '--tags']);
    return !empty($tag) ? $tag : 'dev';
  }

  /**
   * Fetches the date from
   */
  protected function getGitDate() {
    if (!$date = $this->execAndTrim(['log', '-n1', '--pretty=%ci', 'HEAD'])) {
      return NULL;
    }
    $commit_date = new \DateTime($date);
    $commit_date->setTimezone(new \DateTimeZone('UTC'));
    return $commit_date
  }

  /**
   * {@inheritdoc}
   */
  public function getDate() {
    @trigger_error('GitInfoInterface::getDate() is deprecated in eiriksm/gitinfo:4.1.0 and is removed from eiriksm/gitinfo:5.0.0. Use ::getRfc3339Date() or ::getCustomDate().', E_USER_DEPRECATED);
    return $this->getCustomDate('Y-m-d H:m:s');
  }

  /**
   * {@inheritdoc}
   */
  public function getRfc3339Date() {
    return $this->getCustomDate(\DateTimeInterface::RFC3339_EXTENDED);
  }

  /**
   * {@inheritdoc}
   */
  public function getCustomDate(string $format) {
    $date = $this->getGitDate();
    return $date ? $date->format($format) : NULL;
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
  protected function execAndTrim(array $commands) {
    try {
      $process_command = array_merge([$this->gitCommand], $commands);
      $process = new Process($process_command);
      $exit_code = $process->run();
      if ($exit_code) {
        throw new \Exception('Process exited with exit code ' . $exit_code);
      }
      $result = trim($process->getOutput());
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

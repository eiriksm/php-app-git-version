<?php

namespace eiriksm\GitInfo\Tests;

use eiriksm\GitInfo\GitInfo;
use PHPUnit\Framework\TestCase;

class GitInfoTest extends TestCase {

  const BOGUS_COMMAND = 'inTheDepthsOfHell';

  public function testHash() {
    $i = new GitInfo();
    $hash = $i->getShortHash();
    $this->assertNotFalse($hash);
    self::assertEquals($hash, getenv('GITHUB_SHA_SHORT'));
  }

  public function testNoHash() {
    $i = $this->getBadGit();
    $hash = $i->getShortHash();
    $this->assertFalse($hash);
  }

  public function testVersion() {
    $i = new GitInfo();
    $version = $i->getVersion();
    $this->assertNotFalse($version);
  }

  public function testBadVersion() {
    $i = $this->getBadGit();
    $this->assertEquals('dev', $i->getVersion());
  }

  public function testDate() {
    $i = new GitInfo();
    $this->assertNotFalse($i->getDate());
  }

  public function testCustomDate() {
    $i = new GitInfo();
    $this->assertNotNull($i->getCustomDate('U'));
  }

  public function testRfcDate() {
    $i = new GitInfo();
    $this->assertNotNull($i->getRfc3339Date('U'));
  }

  public function testBadDate() {
    $i = $this->getBadGit();
    $this->assertFalse($i->getDate());
  }

  public function testVersionString() {
    $i = new GitInfo();
    $v = $i->getApplicationVersionString();
    $this->assertNotEquals('v.dev', $v);
  }

  public function testBadVersionString() {
    $i = $this->getBadGit();
    $v = $i->getApplicationVersionString();
    $this->assertEquals('v.dev.', $v);
  }

  private function getBadGit() {
    return new GitInfo(self::BOGUS_COMMAND);
  }
}

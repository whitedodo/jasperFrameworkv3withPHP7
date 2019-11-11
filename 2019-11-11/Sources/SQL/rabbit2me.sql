-- --------------------------------------------------------
-- 호스트:                          192.168.0.20
-- 서버 버전:                        10.3.17-MariaDB-0+deb10u1 - Debian 10
-- 서버 OS:                        debian-linux-gnu
-- HeidiSQL 버전:                  10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- tiger 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `tiger` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `tiger`;

-- 테이블 tiger.board_media 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_media` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(20) DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL COMMENT '// 카테고리',
  `mode` varchar(50) DEFAULT NULL,
  `author` text DEFAULT NULL,
  `passwd` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `memo` longtext DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `commentCnt` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `cnt` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_media_comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_media_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `memberId` bigint(20) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_media_file 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_media_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileName` varchar(50) DEFAULT NULL,
  `fileExt` varchar(50) DEFAULT NULL,
  `fileType` varchar(50) DEFAULT NULL,
  `fileSize` bigint(20) DEFAULT NULL,
  `uploadDir` text DEFAULT NULL,
  `realName` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 파일 첨부 게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_media_filelog 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_media_filelog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileId` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 다운로드 로그';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_notice 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_notice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(20) DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL COMMENT '// 카테고리',
  `mode` varchar(50) DEFAULT NULL,
  `author` text DEFAULT NULL,
  `passwd` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `memo` longtext DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `commentCnt` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `cnt` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_notice_comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_notice_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `memberId` bigint(20) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_notice_file 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_notice_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileName` varchar(50) DEFAULT NULL,
  `fileExt` varchar(50) DEFAULT NULL,
  `fileType` varchar(50) DEFAULT NULL,
  `fileSize` bigint(20) DEFAULT NULL,
  `uploadDir` text DEFAULT NULL,
  `realName` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 파일 첨부 게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_notice_filelog 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_notice_filelog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileId` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 다운로드 로그';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_photo 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_photo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(20) DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL COMMENT '// 카테고리',
  `mode` varchar(50) DEFAULT NULL,
  `author` text DEFAULT NULL,
  `passwd` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `memo` longtext DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `commentCnt` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `cnt` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_photo_comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_photo_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `memberId` bigint(20) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_photo_file 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_photo_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileName` varchar(50) DEFAULT NULL,
  `fileExt` varchar(50) DEFAULT NULL,
  `fileType` varchar(50) DEFAULT NULL,
  `fileSize` bigint(20) DEFAULT NULL,
  `uploadDir` text DEFAULT NULL,
  `realName` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 파일 첨부 게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_photo_filelog 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_photo_filelog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileId` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 다운로드 로그';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_project 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_project` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(20) DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL COMMENT '// 카테고리',
  `mode` varchar(50) DEFAULT NULL,
  `author` text DEFAULT NULL,
  `passwd` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `memo` longtext DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `commentCnt` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `cnt` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_project_comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_project_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `memberId` bigint(20) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_project_file 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_project_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileName` varchar(50) DEFAULT NULL,
  `fileExt` varchar(50) DEFAULT NULL,
  `fileType` varchar(50) DEFAULT NULL,
  `fileSize` bigint(20) DEFAULT NULL,
  `uploadDir` text DEFAULT NULL,
  `realName` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 파일 첨부 게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_project_filelog 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_project_filelog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileId` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 다운로드 로그';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_story 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_story` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(20) DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL COMMENT '// 카테고리',
  `mode` varchar(50) DEFAULT NULL,
  `author` text DEFAULT NULL,
  `passwd` text DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `memo` longtext DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `commentCnt` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `cnt` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_story_comment 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_story_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `memberId` bigint(20) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_story_file 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_story_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileName` varchar(50) DEFAULT NULL,
  `fileExt` varchar(50) DEFAULT NULL,
  `fileType` varchar(50) DEFAULT NULL,
  `fileSize` bigint(20) DEFAULT NULL,
  `uploadDir` text DEFAULT NULL,
  `realName` text DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 파일 첨부 게시판';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.board_story_filelog 구조 내보내기
CREATE TABLE IF NOT EXISTS `board_story_filelog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `articleId` bigint(20) DEFAULT NULL,
  `fileId` bigint(20) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='// 다운로드 로그';

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 tiger.member_jasper 구조 내보내기
CREATE TABLE IF NOT EXISTS `member_jasper` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(120) DEFAULT NULL,
  `passwd` text DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL COMMENT '// 성별',
  `birthdate` date DEFAULT NULL,
  `regidate` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='// 회원 기본 가입';

-- 내보낼 데이터가 선택되어 있지 않습니다.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

#!/bin/bash
# make.sh

set -o posix


rig --new-app --name FooBarBaz --domain 'http://localhost:8080'

rig --new-response --for-app 'FooBarBaz' --name 'Foo100Bar18Baz' --position '62.64'

rig --new-response --for-app 'FooBarBaz' --name 'Foo100Bar64Baz' --position '92.95'

rig --new-response --for-app 'FooBarBaz' --name 'Foo100Bar99Baz' --position '72.88'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo10Bar10Baz' --position '72.47'

rig --new-response --for-app 'FooBarBaz' --name 'Foo12Bar41Baz' --position '93.52'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo14Bar47Baz' --position '57.49'

rig --new-response --for-app 'FooBarBaz' --name 'Foo15Bar47Baz' --position '98.29'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo15Bar85Baz' --position '12.23'

rig --new-response --for-app 'FooBarBaz' --name 'Foo15Bar97Baz' --position '1.79'

rig --new-response --for-app 'FooBarBaz' --name 'Foo16Bar53Baz' --position '27.3'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo17Bar90Baz' --position '21.74'

rig --new-response --for-app 'FooBarBaz' --name 'Foo18Bar17Baz' --position '14.68'

rig --new-response --for-app 'FooBarBaz' --name 'Foo20Bar36Baz' --position '96.73'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo22Bar28Baz' --position '16.72'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo23Bar64Baz' --position '21.98'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo24Bar48Baz' --position '47.6'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo24Bar62Baz' --position '45.17'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo24Bar64Baz' --position '77.32'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo25Bar36Baz' --position '93.8'

rig --new-response --for-app 'FooBarBaz' --name 'Foo25Bar58Baz' --position '51.13'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo25Bar69Baz' --position '68.27'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo25Bar90Baz' --position '82.16'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo26Bar26Baz' --position '28.4'

rig --new-response --for-app 'FooBarBaz' --name 'Foo29Bar78Baz' --position '80.15'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo31Bar15Baz' --position '55.46'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo33Bar88Baz' --position '98.71'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo34Bar78Baz' --position '86.38'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo35Bar63Baz' --position '10.42'

rig --new-response --for-app 'FooBarBaz' --name 'Foo35Bar75Baz' --position '77.9'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo36Bar17Baz' --position '24.79'

rig --new-response --for-app 'FooBarBaz' --name 'Foo36Bar61Baz' --position '12.3'

rig --new-response --for-app 'FooBarBaz' --name 'Foo37Bar47Baz' --position '47.36'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo37Bar49Baz' --position '19.24'

rig --new-response --for-app 'FooBarBaz' --name 'Foo37Bar56Baz' --position '96.16'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo37Bar81Baz' --position '90.64'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo40Bar27Baz' --position '3.59'

rig --new-response --for-app 'FooBarBaz' --name 'Foo41Bar20Baz' --position '7.83'

rig --new-response --for-app 'FooBarBaz' --name 'Foo41Bar77Baz' --position '94.18'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo47Bar32Baz' --position '40.52'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo48Bar27Baz' --position '12.48'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo48Bar43Baz' --position '12.87'

rig --new-response --for-app 'FooBarBaz' --name 'Foo48Bar59Baz' --position '5.64'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo49Bar71Baz' --position '31.51'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo50Bar20Baz' --position '96.49'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo51Bar64Baz' --position '86.47'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo52Bar27Baz' --position '82.41'

rig --new-response --for-app 'FooBarBaz' --name 'Foo52Bar66Baz' --position '14.76'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo54Bar63Baz' --position '8.24'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo54Bar74Baz' --position '39.8'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo56Bar92Baz' --position '58.47'

rig --new-response --for-app 'FooBarBaz' --name 'Foo57Bar54Baz' --position '28.7'

rig --new-response --for-app 'FooBarBaz' --name 'Foo61Bar11Baz' --position '45.94'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo61Bar66Baz' --position '99.31'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo61Bar96Baz' --position '89.5'

rig --new-response --for-app 'FooBarBaz' --name 'Foo62Bar82Baz' --position '34.39'

rig --new-response --for-app 'FooBarBaz' --name 'Foo63Bar72Baz' --position '43.9'

rig --new-response --for-app 'FooBarBaz' --name 'Foo65Bar39Baz' --position '32.34'

rig --new-response --for-app 'FooBarBaz' --name 'Foo66Bar33Baz' --position '94.38'

rig --new-response --for-app 'FooBarBaz' --name 'Foo66Bar45Baz' --position '12.2'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo70Bar84Baz' --position '62.86'

rig --new-response --for-app 'FooBarBaz' --name 'Foo72Bar40Baz' --position '29.21'

rig --new-response --for-app 'FooBarBaz' --name 'Foo72Bar64Baz' --position '54.15'

rig --new-response --for-app 'FooBarBaz' --name 'Foo73Bar39Baz' --position '85.76'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo74Bar16Baz' --position '60.8'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo74Bar64Baz' --position '40.6'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo75Bar40Baz' --position '17'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo76Bar65Baz' --position '68.24'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo76Bar68Baz' --position '35.69'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo77Bar41Baz' --position '28.72'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo77Bar76Baz' --position '24.87'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo79Bar21Baz' --position '6.43'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo80Bar32Baz' --position '37.58'

rig --new-response --for-app 'FooBarBaz' --name 'Foo80Bar94Baz' --position '28.58'

rig --new-response --for-app 'FooBarBaz' --name 'Foo82Bar46Baz' --position '2.15'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo83Bar26Baz' --position '60.79'

rig --new-response --for-app 'FooBarBaz' --name 'Foo83Bar64Baz' --position '67.52'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo85Bar20Baz' --position '42.78'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo85Bar38Baz' --position '31.24'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo85Bar60Baz' --position '18.54'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo86Bar48Baz' --position '89.23'

rig --new-response --for-app 'FooBarBaz' --name 'Foo86Bar80Baz' --position '65.39'

rig --new-response --for-app 'FooBarBaz' --name 'Foo87Bar26Baz' --position '6.65'

rig --new-response --for-app 'FooBarBaz' --name 'Foo87Bar84Baz' --position '66.78'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo87Bar89Baz' --position '19.78'

rig --new-response --for-app 'FooBarBaz' --name 'Foo88Bar33Baz' --position '43.53'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo88Bar84Baz' --position '88.16'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo90Bar88Baz' --position '62.55'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo90Bar97Baz' --position '83.16'

rig --new-response --for-app 'FooBarBaz' --name 'Foo92Bar76Baz' --position '97.74'

rig --new-response --for-app 'FooBarBaz' --name 'Foo93Bar74Baz' --position '28.1'

rig --new-response --for-app 'FooBarBaz' --name 'Foo94Bar36Baz' --position '99.84'

rig --new-response --for-app 'FooBarBaz' --name 'Foo96Bar25Baz' --position '22.1'

rig --new-response --for-app 'FooBarBaz' --name 'Foo96Bar50Baz' --position '35.16'

rig --new-response --for-app 'FooBarBaz' --name 'Foo96Bar59Baz' --position '25.58'

rig --new-response --for-app 'FooBarBaz' --name 'Foo97Bar24Baz' --position '82.32'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo97Bar61Baz' --position '24.45'

rig --new-global-response --for-app 'FooBarBaz' --name 'Foo97Bar85Baz' --position '1.41'

rig --new-response --for-app 'FooBarBaz' --name 'Foo98Bar18Baz' --position '84.81'

rig --new-response --for-app 'FooBarBaz' --name 'Foo99Bar35Baz' --position '39.97'

rig --new-response --for-app 'FooBarBaz' --name 'Foo99Bar76Baz' --position '17.63'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar18Baz' --relative-url 'index.php?request=Foo100Bar18Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar18Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar18Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar18Baz2' --relative-url '?Foo14Bar56Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar64Baz' --relative-url 'index.php?request=Foo100Bar64Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar64Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar64Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar64Baz2' --relative-url '?Foo13Bar70Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar99Baz' --relative-url 'index.php?request=Foo100Bar99Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar99Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar99Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo100Bar99Baz2' --relative-url '?Foo91Bar50Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo10Bar10Baz' --relative-url 'index.php?request=Foo10Bar10Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo10Bar10Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo10Bar10Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo10Bar10Baz2' --relative-url '?Foo46Bar45Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo12Bar41Baz' --relative-url 'index.php?request=Foo12Bar41Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo12Bar41Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo12Bar41Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo12Bar41Baz2' --relative-url '?Foo24Bar85Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo14Bar47Baz' --relative-url 'index.php?request=Foo14Bar47Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo14Bar47Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo14Bar47Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo14Bar47Baz2' --relative-url '?Foo96Bar58Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar47Baz' --relative-url 'index.php?request=Foo15Bar47Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar47Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar47Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar47Baz2' --relative-url '?Foo67Bar14Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar85Baz' --relative-url 'index.php?request=Foo15Bar85Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar85Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar85Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar85Baz2' --relative-url '?Foo88Bar78Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar97Baz' --relative-url 'index.php?request=Foo15Bar97Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar97Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar97Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo15Bar97Baz2' --relative-url '?Foo19Bar53Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo16Bar53Baz' --relative-url 'index.php?request=Foo16Bar53Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo16Bar53Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo16Bar53Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo16Bar53Baz2' --relative-url '?Foo12Bar30Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo17Bar90Baz' --relative-url 'index.php?request=Foo17Bar90Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo17Bar90Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo17Bar90Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo17Bar90Baz2' --relative-url '?Foo79Bar90Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo18Bar17Baz' --relative-url 'index.php?request=Foo18Bar17Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo18Bar17Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo18Bar17Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo18Bar17Baz2' --relative-url '?Foo15Bar25Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo20Bar36Baz' --relative-url 'index.php?request=Foo20Bar36Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo20Bar36Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo20Bar36Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo20Bar36Baz2' --relative-url '?Foo52Bar29Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo22Bar28Baz' --relative-url 'index.php?request=Foo22Bar28Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo22Bar28Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo22Bar28Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo22Bar28Baz2' --relative-url '?Foo24Bar44Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo23Bar64Baz' --relative-url 'index.php?request=Foo23Bar64Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo23Bar64Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo23Bar64Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo23Bar64Baz2' --relative-url '?Foo58Bar91Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar48Baz' --relative-url 'index.php?request=Foo24Bar48Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar48Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar48Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar48Baz2' --relative-url '?Foo81Bar51Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar62Baz' --relative-url 'index.php?request=Foo24Bar62Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar62Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar62Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar62Baz2' --relative-url '?Foo44Bar23Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar64Baz' --relative-url 'index.php?request=Foo24Bar64Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar64Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar64Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo24Bar64Baz2' --relative-url '?Foo98Bar40Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar36Baz' --relative-url 'index.php?request=Foo25Bar36Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar36Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar36Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar36Baz2' --relative-url '?Foo82Bar25Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar58Baz' --relative-url 'index.php?request=Foo25Bar58Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar58Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar58Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar58Baz2' --relative-url '?Foo47Bar20Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar69Baz' --relative-url 'index.php?request=Foo25Bar69Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar69Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar69Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar69Baz2' --relative-url '?Foo26Bar20Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar90Baz' --relative-url 'index.php?request=Foo25Bar90Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar90Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar90Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo25Bar90Baz2' --relative-url '?Foo90Bar77Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo26Bar26Baz' --relative-url 'index.php?request=Foo26Bar26Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo26Bar26Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo26Bar26Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo26Bar26Baz2' --relative-url '?Foo28Bar23Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo29Bar78Baz' --relative-url 'index.php?request=Foo29Bar78Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo29Bar78Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo29Bar78Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo29Bar78Baz2' --relative-url '?Foo31Bar54Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo31Bar15Baz' --relative-url 'index.php?request=Foo31Bar15Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo31Bar15Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo31Bar15Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo31Bar15Baz2' --relative-url '?Foo43Bar99Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo33Bar88Baz' --relative-url 'index.php?request=Foo33Bar88Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo33Bar88Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo33Bar88Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo33Bar88Baz2' --relative-url '?Foo25Bar14Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo34Bar78Baz' --relative-url 'index.php?request=Foo34Bar78Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo34Bar78Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo34Bar78Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo34Bar78Baz2' --relative-url '?Foo60Bar33Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar63Baz' --relative-url 'index.php?request=Foo35Bar63Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar63Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar63Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar63Baz2' --relative-url '?Foo91Bar70Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar75Baz' --relative-url 'index.php?request=Foo35Bar75Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar75Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar75Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo35Bar75Baz2' --relative-url '?Foo96Bar63Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar17Baz' --relative-url 'index.php?request=Foo36Bar17Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar17Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar17Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar17Baz2' --relative-url '?Foo51Bar12Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar61Baz' --relative-url 'index.php?request=Foo36Bar61Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar61Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar61Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo36Bar61Baz2' --relative-url '?Foo20Bar100Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar47Baz' --relative-url 'index.php?request=Foo37Bar47Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar47Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar47Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar47Baz2' --relative-url '?Foo20Bar95Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar49Baz' --relative-url 'index.php?request=Foo37Bar49Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar49Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar49Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar49Baz2' --relative-url '?Foo28Bar89Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar56Baz' --relative-url 'index.php?request=Foo37Bar56Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar56Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar56Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar56Baz2' --relative-url '?Foo48Bar22Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar81Baz' --relative-url 'index.php?request=Foo37Bar81Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar81Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar81Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo37Bar81Baz2' --relative-url '?Foo92Bar43Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo40Bar27Baz' --relative-url 'index.php?request=Foo40Bar27Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo40Bar27Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo40Bar27Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo40Bar27Baz2' --relative-url '?Foo19Bar83Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar20Baz' --relative-url 'index.php?request=Foo41Bar20Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar20Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar20Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar20Baz2' --relative-url '?Foo38Bar21Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar77Baz' --relative-url 'index.php?request=Foo41Bar77Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar77Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar77Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo41Bar77Baz2' --relative-url '?Foo60Bar99Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo47Bar32Baz' --relative-url 'index.php?request=Foo47Bar32Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo47Bar32Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo47Bar32Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo47Bar32Baz2' --relative-url '?Foo83Bar47Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar27Baz' --relative-url 'index.php?request=Foo48Bar27Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar27Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar27Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar27Baz2' --relative-url '?Foo75Bar96Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar43Baz' --relative-url 'index.php?request=Foo48Bar43Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar43Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar43Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar43Baz2' --relative-url '?Foo14Bar59Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar59Baz' --relative-url 'index.php?request=Foo48Bar59Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar59Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar59Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo48Bar59Baz2' --relative-url '?Foo60Bar60Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo49Bar71Baz' --relative-url 'index.php?request=Foo49Bar71Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo49Bar71Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo49Bar71Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo49Bar71Baz2' --relative-url '?Foo97Bar48Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo50Bar20Baz' --relative-url 'index.php?request=Foo50Bar20Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo50Bar20Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo50Bar20Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo50Bar20Baz2' --relative-url '?Foo35Bar27Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo51Bar64Baz' --relative-url 'index.php?request=Foo51Bar64Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo51Bar64Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo51Bar64Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo51Bar64Baz2' --relative-url '?Foo26Bar34Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar27Baz' --relative-url 'index.php?request=Foo52Bar27Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar27Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar27Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar27Baz2' --relative-url '?Foo19Bar87Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar66Baz' --relative-url 'index.php?request=Foo52Bar66Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar66Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar66Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo52Bar66Baz2' --relative-url '?Foo57Bar36Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar63Baz' --relative-url 'index.php?request=Foo54Bar63Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar63Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar63Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar63Baz2' --relative-url '?Foo64Bar39Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar74Baz' --relative-url 'index.php?request=Foo54Bar74Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar74Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar74Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo54Bar74Baz2' --relative-url '?Foo85Bar91Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo56Bar92Baz' --relative-url 'index.php?request=Foo56Bar92Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo56Bar92Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo56Bar92Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo56Bar92Baz2' --relative-url '?Foo89Bar22Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo57Bar54Baz' --relative-url 'index.php?request=Foo57Bar54Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo57Bar54Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo57Bar54Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo57Bar54Baz2' --relative-url '?Foo97Bar69Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar11Baz' --relative-url 'index.php?request=Foo61Bar11Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar11Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar11Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar11Baz2' --relative-url '?Foo23Bar41Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar66Baz' --relative-url 'index.php?request=Foo61Bar66Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar66Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar66Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar66Baz2' --relative-url '?Foo13Bar20Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar96Baz' --relative-url 'index.php?request=Foo61Bar96Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar96Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar96Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo61Bar96Baz2' --relative-url '?Foo16Bar58Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo62Bar82Baz' --relative-url 'index.php?request=Foo62Bar82Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo62Bar82Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo62Bar82Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo62Bar82Baz2' --relative-url '?Foo98Bar12Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo63Bar72Baz' --relative-url 'index.php?request=Foo63Bar72Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo63Bar72Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo63Bar72Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo63Bar72Baz2' --relative-url '?Foo26Bar53Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo65Bar39Baz' --relative-url 'index.php?request=Foo65Bar39Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo65Bar39Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo65Bar39Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo65Bar39Baz2' --relative-url '?Foo53Bar52Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar33Baz' --relative-url 'index.php?request=Foo66Bar33Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar33Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar33Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar33Baz2' --relative-url '?Foo55Bar11Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar45Baz' --relative-url 'index.php?request=Foo66Bar45Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar45Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar45Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo66Bar45Baz2' --relative-url '?Foo86Bar74Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo70Bar84Baz' --relative-url 'index.php?request=Foo70Bar84Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo70Bar84Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo70Bar84Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo70Bar84Baz2' --relative-url '?Foo98Bar73Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar40Baz' --relative-url 'index.php?request=Foo72Bar40Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar40Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar40Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar40Baz2' --relative-url '?Foo34Bar55Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar64Baz' --relative-url 'index.php?request=Foo72Bar64Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar64Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar64Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo72Bar64Baz2' --relative-url '?Foo25Bar17Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo73Bar39Baz' --relative-url 'index.php?request=Foo73Bar39Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo73Bar39Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo73Bar39Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo73Bar39Baz2' --relative-url '?Foo62Bar10Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar16Baz' --relative-url 'index.php?request=Foo74Bar16Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar16Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar16Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar16Baz2' --relative-url '?Foo48Bar71Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar64Baz' --relative-url 'index.php?request=Foo74Bar64Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar64Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar64Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo74Bar64Baz2' --relative-url '?Foo46Bar71Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo75Bar40Baz' --relative-url 'index.php?request=Foo75Bar40Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo75Bar40Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo75Bar40Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo75Bar40Baz2' --relative-url '?Foo67Bar48Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar65Baz' --relative-url 'index.php?request=Foo76Bar65Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar65Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar65Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar65Baz2' --relative-url '?Foo26Bar15Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar68Baz' --relative-url 'index.php?request=Foo76Bar68Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar68Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar68Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo76Bar68Baz2' --relative-url '?Foo14Bar33Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar41Baz' --relative-url 'index.php?request=Foo77Bar41Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar41Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar41Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar41Baz2' --relative-url '?Foo83Bar33Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar76Baz' --relative-url 'index.php?request=Foo77Bar76Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar76Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar76Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo77Bar76Baz2' --relative-url '?Foo98Bar93Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo79Bar21Baz' --relative-url 'index.php?request=Foo79Bar21Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo79Bar21Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo79Bar21Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo79Bar21Baz2' --relative-url '?Foo98Bar46Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar32Baz' --relative-url 'index.php?request=Foo80Bar32Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar32Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar32Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar32Baz2' --relative-url '?Foo68Bar65Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar94Baz' --relative-url 'index.php?request=Foo80Bar94Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar94Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar94Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo80Bar94Baz2' --relative-url '?Foo56Bar56Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo82Bar46Baz' --relative-url 'index.php?request=Foo82Bar46Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo82Bar46Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo82Bar46Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo82Bar46Baz2' --relative-url '?Foo81Bar54Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar26Baz' --relative-url 'index.php?request=Foo83Bar26Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar26Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar26Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar26Baz2' --relative-url '?Foo72Bar46Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar64Baz' --relative-url 'index.php?request=Foo83Bar64Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar64Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar64Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo83Bar64Baz2' --relative-url '?Foo71Bar16Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar20Baz' --relative-url 'index.php?request=Foo85Bar20Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar20Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar20Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar20Baz2' --relative-url '?Foo21Bar12Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar38Baz' --relative-url 'index.php?request=Foo85Bar38Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar38Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar38Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar38Baz2' --relative-url '?Foo82Bar81Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar60Baz' --relative-url 'index.php?request=Foo85Bar60Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar60Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar60Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo85Bar60Baz2' --relative-url '?Foo89Bar81Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar48Baz' --relative-url 'index.php?request=Foo86Bar48Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar48Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar48Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar48Baz2' --relative-url '?Foo78Bar29Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar80Baz' --relative-url 'index.php?request=Foo86Bar80Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar80Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar80Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo86Bar80Baz2' --relative-url '?Foo81Bar89Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar26Baz' --relative-url 'index.php?request=Foo87Bar26Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar26Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar26Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar26Baz2' --relative-url '?Foo54Bar99Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar84Baz' --relative-url 'index.php?request=Foo87Bar84Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar84Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar84Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar84Baz2' --relative-url '?Foo63Bar61Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar89Baz' --relative-url 'index.php?request=Foo87Bar89Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar89Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar89Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo87Bar89Baz2' --relative-url '?Foo62Bar26Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar33Baz' --relative-url 'index.php?request=Foo88Bar33Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar33Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar33Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar33Baz2' --relative-url '?Foo84Bar51Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar84Baz' --relative-url 'index.php?request=Foo88Bar84Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar84Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar84Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo88Bar84Baz2' --relative-url '?Foo38Bar22Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar88Baz' --relative-url 'index.php?request=Foo90Bar88Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar88Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar88Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar88Baz2' --relative-url '?Foo55Bar66Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar97Baz' --relative-url 'index.php?request=Foo90Bar97Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar97Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar97Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo90Bar97Baz2' --relative-url '?Foo69Bar75Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo92Bar76Baz' --relative-url 'index.php?request=Foo92Bar76Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo92Bar76Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo92Bar76Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo92Bar76Baz2' --relative-url '?Foo16Bar86Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo93Bar74Baz' --relative-url 'index.php?request=Foo93Bar74Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo93Bar74Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo93Bar74Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo93Bar74Baz2' --relative-url '?Foo75Bar100Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo94Bar36Baz' --relative-url 'index.php?request=Foo94Bar36Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo94Bar36Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo94Bar36Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo94Bar36Baz2' --relative-url '?Foo76Bar12Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar25Baz' --relative-url 'index.php?request=Foo96Bar25Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar25Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar25Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar25Baz2' --relative-url '?Foo100Bar17Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar50Baz' --relative-url 'index.php?request=Foo96Bar50Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar50Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar50Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar50Baz2' --relative-url '?Foo24Bar95Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar59Baz' --relative-url 'index.php?request=Foo96Bar59Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar59Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar59Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo96Bar59Baz2' --relative-url '?Foo79Bar84Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar24Baz' --relative-url 'index.php?request=Foo97Bar24Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar24Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar24Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar24Baz2' --relative-url '?Foo49Bar32Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar61Baz' --relative-url 'index.php?request=Foo97Bar61Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar61Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar61Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar61Baz2' --relative-url '?Foo74Bar87Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar85Baz' --relative-url 'index.php?request=Foo97Bar85Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar85Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar85Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo97Bar85Baz2' --relative-url '?Foo46Bar28Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo98Bar18Baz' --relative-url 'index.php?request=Foo98Bar18Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo98Bar18Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo98Bar18Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo98Bar18Baz2' --relative-url '?Foo55Bar94Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar35Baz' --relative-url 'index.php?request=Foo99Bar35Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar35Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar35Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar35Baz2' --relative-url '?Foo85Bar70Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar76Baz' --relative-url 'index.php?request=Foo99Bar76Baz' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar76Baz0' --relative-url '' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar76Baz1' --relative-url 'index.php' --container 'FooBarBazRequests'

rig --new-request --for-app 'FooBarBaz' --name 'Foo99Bar76Baz2' --relative-url '?Foo38Bar80Baz' --container 'FooBarBazRequests'

rig --new-output-component --for-app 'FooBarBaz' --name 'AAA' --output '<p>AAA</p>' --container 'OutputComponents' --position '0'

rig --new-output-component --for-app 'FooBarBaz' --name 'BBB' --output '<p>BBB</p>' --container 'OutputComponents' --position '0'

rig --new-output-component --for-app 'FooBarBaz' --name 'CCC' --output '<p>CCC</p>' --container 'AltOutput' --position '100'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'DDD' --container 'DynamicOutputComponents' --position '4.2' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo100Bar18Baz' --container 'FooBarBazDynamicOutput' --position '68.2' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo100Bar64Baz' --output '<h1>Duo Reges: constructio interrete.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod iam a me expectare noli. Ut aliquid scire se gaudeant? Nemo igitur esse beatus potest. Si longus, levis dictata sunt. </p>

<p>Qualem igitur hominem natura inchoavit? An hoc usque quaque, aliter in vita? Ubi ut eam caperet aut quando? Aufert enim sensus actionemque tollit omnem. Quo tandem modo? </p>

<p>Eam tum adesse, cum dolor omnis absit; Sed haec omittamus; Avaritiamne minuis? De illis, cum volemus. </p>

<p>Solum praeterea formosum, solum liberum, solum civem, stultost; In schola desinis. Istic sum, inquit. Sed quod proximum fuit non vidit. Praeteritis, inquit, gaudeo. Age, inquies, ista parva sunt. </p>

<p>Aliter enim explicari, quod quaeritur, non potest. Erat enim Polemonis. Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus; Qua tu etiam inprudens utebare non numquam. Respondeat totidem verbis. </p>

<p>Tum Quintus: Est plane, Piso, ut dicis, inquit. Confecta res esset. Memini vero, inquam; </p>

<p>De hominibus dici non necesse est. Respondent extrema primis, media utrisque, omnia omnibus. </p>

<p>At multis se probavit. Quis istud, quaeso, nesciebat? Minime vero istorum quidem, inquit. </p>

<p>Si quidem, inquit, tollerem, sed relinquo. Non autem hoc: igitur ne illud quidem. Collatio igitur ista te nihil iuvat. Certe non potest. Quis enim redargueret? Philosophi autem in suis lectulis plerumque moriuntur. Non potes, nisi retexueris illa. Haec dicuntur inconstantissime. Ut id aliis narrare gestiant? </p>

<p>Putabam equidem satis, inquit, me dixisse. Cur iustitia laudatur? Zenonis est, inquam, hoc Stoici. Quod vestri non item. Tubulo putas dicere? Quid autem habent admirationis, cum prope accesseris? Paria sunt igitur. Minime vero istorum quidem, inquit. </p>' --container 'FooBarBazOutput' --position '3.26'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo100Bar99Baz' --output '<h1>Tu enim ista lenius, hic Stoicorum more nos vexat.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quare conare, quaeso. Sed fortuna fortis; Quo plebiscito decreta a senatu est consuli quaestio Cn. Ut aliquid scire se gaudeant? Non est igitur voluptas bonum. Duo Reges: constructio interrete. </p>

<p>Quis istud possit, inquit, negare? Itaque contra est, ac dicitis; Ut aliquid scire se gaudeant? </p>

<p>Iam contemni non poteris. Sed virtutem ipsam inchoavit, nihil amplius. Duo enim genera quae erant, fecit tria. Qua tu etiam inprudens utebare non numquam. </p>

<h3>Ut optime, secundum naturam affectum esse possit.</h3>

<p>Tum ille: Ain tandem? Non laboro, inquit, de nomine. Nulla erit controversia. Ecce aliud simile dissimile. Itaque his sapiens semper vacabit. </p>

<p>Iam in altera philosophiae parte. Quis non odit sordidos, vanos, leves, futtiles? Nemo nostrum istius generis asotos iucunde putat vivere. Non semper, inquam; </p>

<p>Mihi enim erit isdem istis fortasse iam utendum. Mihi enim satis est, ipsis non satis. Hic ambiguo ludimur. Nunc vides, quid faciat. A mene tu? Nemo igitur esse beatus potest. Sed tamen intellego quid velit. Immo videri fortasse. </p>

<p>Polycratem Samium felicem appellabant. Quamquam haec quidem praeposita recte et reiecta dicere licebit. An eiusdem modi? Luxuriam non reprehendit, modo sit vacua infinita cupiditate et timore. Venit ad extremum; Quid nunc honeste dicit? </p>

<p>Idemne, quod iucunde? Mihi, inquam, qui te id ipsum rogavi? Quod totum contra est. Tum Torquatus: Prorsus, inquit, assentior; </p>

<h2>Conclusum est enim contra Cyrenaicos satis acute, nihil ad Epicurum.</h2>

<p>Primum Theophrasti, Strato, physicum se voluit; Nos vero, inquit ille; Et nemo nimium beatus est; Verum hoc idem saepe faciamus. </p>

<p>Quis est tam dissimile homini. Quis est tam dissimile homini. Nihilo beatiorem esse Metellum quam Regulum. Si quicquam extra virtutem habeatur in bonis. Peccata paria. </p>' --container 'FooBarBazOutput' --position '14.51'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo10Bar10Baz' --container 'FooBarBazDynamicOutput' --position '86.35' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo12Bar41Baz' --container 'FooBarBazDynamicOutput' --position '54.87' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo14Bar47Baz' --output '<h1>In his igitur partibus duabus nihil erat, quod Zeno commutare gestiret.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Scrupulum, inquam, abeunti; Quae similitudo in genere etiam humano apparet. Sed in rebus apertissimis nimium longi sumus. Duo Reges: constructio interrete. At certe gravius. Duo enim genera quae erant, fecit tria. </p>

<h1>Quasi ego id curem, quid ille aiat aut neget.</h1>

<p>Equidem e Cn. Conferam avum tuum Drusum cum C. Deinde dolorem quem maximum? Is es profecto tu. </p>

<h3>Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus;</h3>

<p>Summum ením bonum exposuit vacuitatem doloris; Moriatur, inquit. </p>

<h6>An vero, inquit, quisquam potest probare, quod perceptfum, quod.</h6>

<p>Sed quid attinet de rebus tam apertis plura requirere? Inde igitur, inquit, ordiendum est. Quis istud possit, inquit, negare? Hic ambiguo ludimur. </p>

<h2>Aliter homines, aliter philosophos loqui putas oportere?</h2>

<p>Cave putes quicquam esse verius. Sint ista Graecorum; Recte dicis; Eadem nunc mea adversum te oratio est. </p>

<p>Gerendus est mos, modo recte sentiat. Haec quo modo conveniant, non sane intellego. Nam quid possumus facere melius? Quippe: habes enim a rhetoribus; Urgent tamen et nihil remittunt. Quid sequatur, quid repugnet, vident. </p>

<h5>Sed quid attinet de rebus tam apertis plura requirere?</h5>

<p>An haec ab eo non dicuntur? Tum Piso: Quoniam igitur aliquid omnes, quid Lucius noster? Hoc sic expositum dissimile est superiori. Ex rebus enim timiditas, non ex vocabulis nascitur. Tu quidem reddes; Idem adhuc; </p>

<h4>Quae autem natura suae primae institutionis oblita est?</h4>

<p>Istam voluptatem perpetuam quis potest praestare sapienti? Quid enim? Quid ad utilitatem tantae pecuniae? Aliter autem vobis placet. Disserendi artem nullam habuit. </p>

<p>Maximas vero virtutes iacere omnis necesse est voluptate dominante. Sed tamen intellego quid velit. Itaque ad tempus ad Pisonem omnes. Scio enim esse quosdam, qui quavis lingua philosophari possint; </p>

<p>Bonum incolumis acies: misera caecitas. Iubet igitur nos Pythius Apollo noscere nosmet ipsos. </p>' --container 'FooBarBazOutput' --position '96.9'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo15Bar47Baz' --output '<h1>Quo modo autem philosophus loquitur?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quorum sine causa fieri nihil putandum est. Si longus, levis. Non est ista, inquam, Piso, magna dissensio. Qui non moveatur et offensione turpitudinis et comprobatione honestatis? Duo Reges: constructio interrete. Tollenda est atque extrahenda radicitus. </p>

<h3>Vide, quaeso, rectumne sit.</h3>

<p>Istam voluptatem, inquit, Epicurus ignorat? Est, ut dicis, inquam. Idemque diviserunt naturam hominis in animum et corpus. Quid ait Aristoteles reliquique Platonis alumni? Quid nunc honeste dicit? Certe non potest. </p>

<p>Quae est igitur causa istarum angustiarum? Occultum facinus esse potuerit, gaudebit; Respondent extrema primis, media utrisque, omnia omnibus. Apparet statim, quae sint officia, quae actiones. Sapientem locupletat ipsa natura, cuius divitias Epicurus parabiles esse docuit. Tum mihi Piso: Quid ergo? </p>

<p>Mihi, inquam, qui te id ipsum rogavi? Tum ille timide vel potius verecunde: Facio, inquit. </p>

<h4>Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse;</h4>

<p>Id Sextilius factum negabat. Estne, quaeso, inquam, sitienti in bibendo voluptas? In schola desinis. Sed fortuna fortis; </p>

<h5>Sed ego in hoc resisto;</h5>

<p>Quae cum dixisset paulumque institisset, Quid est? Ita nemo beato beatior. At iam decimum annum in spelunca iacet. Tibi hoc incredibile, quod beatissimum. At iam decimum annum in spelunca iacet. Sed ille, ut dixi, vitiose. </p>

<p>Sit enim idem caecus, debilis. Nummus in Croesi divitiis obscuratur, pars est tamen divitiarum. </p>

<p>Cur iustitia laudatur? Quantum Aristoxeni ingenium consumptum videmus in musicis? Sic enim censent, oportunitatis esse beate vivere. Sed quot homines, tot sententiae; Quamquam te quidem video minime esse deterritum. Nondum autem explanatum satis, erat, quid maxime natura vellet. </p>

<p>Quid igitur, inquit, eos responsuros putas? An haec ab eo non dicuntur? Venit ad extremum; Profectus in exilium Tubulus statim nec respondere ausus; Frater et T. Si longus, levis dictata sunt. </p>

<h2>Si verbum sequimur, primum longius verbum praepositum quam bonum.</h2>

<p>Ut pulsi recurrant? Quid ergo? Ut optime, secundum naturam affectum esse possit. Hic ambiguo ludimur. Eam stabilem appellas. Tum ille: Ain tandem? </p>' --container 'FooBarBazOutput' --position '76.91'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo15Bar85Baz' --output '<h1>Non igitur potestis voluptate omnia dirigentes aut tueri aut retinere virtutem.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam beatissimum? Ostendit pedes et pectus. Sumenda potius quam expetenda. Haec dicuntur inconstantissime. Duo Reges: constructio interrete. Istam voluptatem, inquit, Epicurus ignorat? </p>

<h2>Illis videtur, qui illud non dubitant bonum dicere -;</h2>

<p>Qua ex cognitione facilior facta est investigatio rerum occultissimarum. Certe, nisi voluptatem tanti aestimaretis. Quorum sine causa fieri nihil putandum est. Si enim ad populum me vocas, eum. Sed residamus, inquit, si placet. Ratio quidem vestra sic cogit. At hoc in eo M. </p>

<h3>Vitae autem degendae ratio maxime quidem illis placuit quieta.</h3>

<p>Immo alio genere; Eam stabilem appellas. Maximus dolor, inquit, brevis est. Satis est ad hoc responsum. Nemo igitur esse beatus potest. Facile est hoc cernere in primis puerorum aetatulis. Diodorus, eius auditor, adiungit ad honestatem vacuitatem doloris. Quid censes in Latino fore? </p>

<p>Illa tamen simplicia, vestra versuta. Quam nemo umquam voluptatem appellavit, appellat; Ita credo. At multis malis affectus. Igitur ne dolorem quidem. Quid est igitur, inquit, quod requiras? Gloriosa ostentatio in constituendo summo bono. Summum a vobis bonum voluptas dicitur. </p>

<p>Sed haec in pueris; Utilitatis causa amicitia est quaesita. Tamen a proposito, inquam, aberramus. Numquam facies. Stoici scilicet. Quo tandem modo? </p>

<p>Videsne quam sit magna dissensio? Restinguet citius, si ardentem acceperit. Qui non moveatur et offensione turpitudinis et comprobatione honestatis? Non laboro, inquit, de nomine. Istam voluptatem perpetuam quis potest praestare sapienti? Si longus, levis. </p>

<p>Respondeat totidem verbis. Ita prorsus, inquam; Non laboro, inquit, de nomine. </p>

<p>Venit ad extremum; Nam ante Aristippus, et ille melius. Cur iustitia laudatur? Collatio igitur ista te nihil iuvat. </p>

<p>Que Manilium, ab iisque M. Quod ea non occurrentia fingunt, vincunt Aristonem; Suo enim quisque studio maxime ducitur. Si longus, levis; </p>

<p>Cur deinde Metrodori liberos commendas? At enim sequor utilitatem. Et nemo nimium beatus est; Murenam te accusante defenderem. Negat esse eam, inquit, propter se expetendam. </p>' --container 'FooBarBazOutput' --position '97.72'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo15Bar97Baz' --container 'FooBarBazDynamicOutput' --position '64.62' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo16Bar53Baz' --output '<h1>At iam decimum annum in spelunca iacet.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. At enim sequor utilitatem. Duo Reges: constructio interrete. Nescio quo modo praetervolavit oratio. Expectoque quid ad id, quod quaerebam, respondeas. </p>

<p>Sed eum qui audiebant, quoad poterant, defendebant sententiam suam. Idem iste, inquam, de voluptate quid sentit? Minime vero, inquit ille, consentit. </p>

<p>Sin tantum modo ad indicia veteris memoriae cognoscenda, curiosorum. Praeteritis, inquit, gaudeo. Sed potestne rerum maior esse dissensio? Sed nimis multa. </p>

<h2>Ita multo sanguine profuso in laetitia et in victoria est mortuus.</h2>

<p>Sumenda potius quam expetenda. At enim hic etiam dolore. Philosophi autem in suis lectulis plerumque moriuntur. </p>

<p>Ut aliquid scire se gaudeant? Quid ait Aristoteles reliquique Platonis alumni? Itaque his sapiens semper vacabit. Nos commodius agimus. Istam voluptatem, inquit, Epicurus ignorat? Suo enim quisque studio maxime ducitur. </p>

<h5>Quid sequatur, quid repugnet, vident.</h5>

<p>Quae cum dixisset, finem ille. Occultum facinus esse potuerit, gaudebit; Illa tamen simplicia, vestra versuta. Negat esse eam, inquit, propter se expetendam. </p>

<p>Sed haec omittamus; Non semper, inquam; Ego vero isti, inquam, permitto. Certe non potest. </p>

<p>Videsne quam sit magna dissensio? Etenim semper illud extra est, quod arte comprehenditur. Videamus igitur sententias eorum, tum ad verba redeamus. At ego quem huic anteponam non audeo dicere; Oratio me istius philosophi non offendit; Negat enim summo bono afferre incrementum diem. </p>

<h4>Venit enim mihi Platonis in mentem, quem accepimus primum hic disputare solitum;</h4>

<p>At multis malis affectus. Duo enim genera quae erant, fecit tria. Illi enim inter se dissentiunt. Verum hoc idem saepe faciamus. Polycratem Samium felicem appellabant. Gloriosa ostentatio in constituendo summo bono. Tubulo putas dicere? Quod totum contra est. </p>

<h3>Ita graviter et severe voluptatem secrevit a bono.</h3>

<p>Id Sextilius factum negabat. Quo modo autem philosophus loquitur? Sin aliud quid voles, postea. Hic nihil fuit, quod quaereremus. Haec dicuntur inconstantissime. </p>' --container 'FooBarBazOutput' --position '15.1'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo17Bar90Baz' --container 'FooBarBazDynamicOutput' --position '62.42' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo18Bar17Baz' --container 'FooBarBazDynamicOutput' --position '10.57' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo20Bar36Baz' --output '<h1>Si enim ad populum me vocas, eum.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non enim iam stirpis bonum quaeret, sed animalis. Quae sequuntur igitur? </p>

<h3>Ex quo, id quod omnes expetunt, beate vivendi ratio inveniri et comparari potest.</h3>

<p>Vide, quantum, inquam, fallare, Torquate. Quae cum dixisset paulumque institisset, Quid est? Nihil illinc huc pervenit. Idemne, quod iucunde? Polycratem Samium felicem appellabant. Quae duo sunt, unum facit. Oratio me istius philosophi non offendit; An eiusdem modi? </p>

<h4>Certe nihil nisi quod possit ipsum propter se iure laudari.</h4>

<p>Scrupulum, inquam, abeunti; Pauca mutat vel plura sane; Pauca mutat vel plura sane; Hos contra singulos dici est melius. Huius ego nunc auctoritatem sequens idem faciam. Qui autem esse poteris, nisi te amor ipse ceperit? Equidem e Cn. Iam contemni non poteris. </p>

<p>Nam quid possumus facere melius? Oratio me istius philosophi non offendit; Iam id ipsum absurdum, maximum malum neglegi. Respondent extrema primis, media utrisque, omnia omnibus. </p>

<h6>Dolor ergo, id est summum malum, metuetur semper, etiamsi non aderit;</h6>

<p>Sed haec in pueris; Restinguet citius, si ardentem acceperit. An eiusdem modi? An eiusdem modi? </p>

<h2>Cum id fugiunt, re eadem defendunt, quae Peripatetici, verba.</h2>

<p>Nulla erit controversia. Duo Reges: constructio interrete. Quare attende, quaeso. Sit sane ista voluptas. Quo tandem modo? Negat enim summo bono afferre incrementum diem. </p>

<h1>Dicet pro me ipsa virtus nec dubitabit isti vestro beato M.</h1>

<p>Quis istum dolorem timet? Negare non possum. Ego vero isti, inquam, permitto. Praeclare hoc quidem. Egone quaeris, inquit, quid sentiam? Audeo dicere, inquit. </p>

<p>Quis non odit sordidos, vanos, leves, futtiles? Hoc Hieronymus summum bonum esse dixit. An tu me de L. Sedulo, inquam, faciam. </p>

<h5>Graecum enim hunc versum nostis omnes-: Suavis laborum est praeteritorum memoria.</h5>

<p>Sed residamus, inquit, si placet. Bestiarum vero nullum iudicium puto. Quod equidem non reprehendo; Quae contraria sunt his, malane? Negat enim summo bono afferre incrementum diem. Recte, inquit, intellegis. Vide, quantum, inquam, fallare, Torquate. Primum Theophrasti, Strato, physicum se voluit; </p>

<p>Nunc haec primum fortasse audientis servire debemus. Quos quidem tibi studiose et diligenter tractandos magnopere censeo. Proclivi currit oratio. Tamen a proposito, inquam, aberramus. At, si voluptas esset bonum, desideraret. Cur iustitia laudatur? </p>' --container 'FooBarBazOutput' --position '82.35'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo22Bar28Baz' --output '<h1>Sed erat aequius Triarium aliquid de dissensione nostra iudicare.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ego vero isti, inquam, permitto. Erit enim mecum, si tecum erit. Urgent tamen et nihil remittunt. Quae duo sunt, unum facit. Hoc simile tandem est? Ut optime, secundum naturam affectum esse possit. Duo Reges: constructio interrete. </p>

<h3>Quid ergo hoc loco intellegit honestum?</h3>

<p>Quamquam tu hanc copiosiorem etiam soles dicere. At eum nihili facit; Ipse Epicurus fortasse redderet, ut Sextus Peducaeus, Sex. Ego vero isti, inquam, permitto. Egone quaeris, inquit, quid sentiam? </p>

<h2>Ut non sine causa ex iis memoriae ducta sit disciplina.</h2>

<p>Quacumque enim ingredimur, in aliqua historia vestigium ponimus. Videsne quam sit magna dissensio? Putabam equidem satis, inquit, me dixisse. Quae duo sunt, unum facit. Hic nihil fuit, quod quaereremus. Sed quae tandem ista ratio est? </p>

<p>Maximus dolor, inquit, brevis est. Utinam quidem dicerent alium alio beatiorem! Iam ruinas videres. Bestiarum vero nullum iudicium puto. Primum divisit ineleganter; Fortasse id optimum, sed ubi illud: Plus semper voluptatis? Summum ením bonum exposuit vacuitatem doloris; </p>

<p>Quid de Pythagora? Venit ad extremum; Quid ergo? Murenam te accusante defenderem. Eaedem res maneant alio modo. Qui autem esse poteris, nisi te amor ipse ceperit? </p>

<p>Immo alio genere; Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; Summae mihi videtur inscitiae. Confecta res esset. Eaedem res maneant alio modo. Iam id ipsum absurdum, maximum malum neglegi. </p>

<p>Recte, inquit, intellegis. Illud non continuo, ut aeque incontentae. Illi enim inter se dissentiunt. Sint ista Graecorum; </p>

<p>Utilitatis causa amicitia est quaesita. Que Manilium, ab iisque M. Sed ad bona praeterita redeamus. Eam stabilem appellas. Quae cum essent dicta, discessimus. Hoc ipsum elegantius poni meliusque potuit. </p>

<p>Si quicquam extra virtutem habeatur in bonis. Confecta res esset. Quodsi ipsam honestatem undique pertectam atque absolutam. Non semper, inquam; Dici enim nihil potest verius. Id enim natura desiderat. </p>

<p>Haec quo modo conveniant, non sane intellego. Ut pulsi recurrant? Proclivi currit oratio. Conferam avum tuum Drusum cum C. Paria sunt igitur. </p>' --container 'FooBarBazOutput' --position '99.45'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo23Bar64Baz' --output '<h1>Item de contrariis, a quibus ad genera formasque generum venerunt.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sint ista Graecorum; Primum in nostrane potestate est, quid meminerimus? Urgent tamen et nihil remittunt. Duo Reges: constructio interrete. </p>

<p>Scaevolam M. Paria sunt igitur. Huius ego nunc auctoritatem sequens idem faciam. </p>

<h4>A primo, ut opinor, animantium ortu petitur origo summi boni.</h4>

<p>Pugnant Stoici cum Peripateticis. Nunc vides, quid faciat. Quacumque enim ingredimur, in aliqua historia vestigium ponimus. Esse enim quam vellet iniquus iustus poterat inpune. Occultum facinus esse potuerit, gaudebit; </p>

<h2>Universa enim illorum ratione cum tota vestra confligendum puto.</h2>

<p>Ita prorsus, inquam; Cyrenaici quidem non recusant; Primum divisit ineleganter; Minime vero, inquit ille, consentit. Qui convenit? Non est igitur voluptas bonum. </p>

<p>Primum quid tu dicis breve? Primum quid tu dicis breve? </p>

<p>Prioris generis est docilitas, memoria; Quis est tam dissimile homini. Cur post Tarentum ad Archytam? </p>

<p>Urgent tamen et nihil remittunt. Non potes, nisi retexueris illa. Quod quidem iam fit etiam in Academia. Inde igitur, inquit, ordiendum est. Quis est tam dissimile homini. </p>

<h3>Videamus animi partes, quarum est conspectus illustrior;</h3>

<p>Quid igitur, inquit, eos responsuros putas? Nihil enim iam habes, quod ad corpus referas; Omnia peccata paria dicitis. Sed virtutem ipsam inchoavit, nihil amplius. Quae diligentissime contra Aristonem dicuntur a Chryippo. </p>

<p>Aliter homines, aliter philosophos loqui putas oportere? Sic consequentibus vestris sublatis prima tolluntur. At hoc in eo M. Ut in geometria, prima si dederis, danda sunt omnia. Sed haec in pueris; Tenent mordicus. </p>

<p>At certe gravius. Negare non possum. Sed ego in hoc resisto; Quis istud possit, inquit, negare? </p>' --container 'FooBarBazOutput' --position '19.64'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo24Bar48Baz' --container 'FooBarBazDynamicOutput' --position '61.82' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo24Bar62Baz' --container 'FooBarBazDynamicOutput' --position '83.27' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo24Bar64Baz' --container 'FooBarBazDynamicOutput' --position '55.47' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo25Bar36Baz' --container 'FooBarBazDynamicOutput' --position '74.22' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo25Bar58Baz' --container 'FooBarBazDynamicOutput' --position '5.45' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo25Bar69Baz' --container 'FooBarBazDynamicOutput' --position '87.5' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo25Bar90Baz' --container 'FooBarBazDynamicOutput' --position '65.4' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo26Bar26Baz' --container 'FooBarBazDynamicOutput' --position '33.38' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo29Bar78Baz' --container 'FooBarBazDynamicOutput' --position '21.1' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo31Bar15Baz' --container 'FooBarBazDynamicOutput' --position '53.1' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo33Bar88Baz' --container 'FooBarBazDynamicOutput' --position '45.12' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo34Bar78Baz' --output '<h1>Nunc vides, quid faciat.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod cum dixissent, ille contra. Nihil enim iam habes, quod ad corpus referas; Cur post Tarentum ad Archytam? Quis Aristidem non mortuum diligit? </p>

<p>Primum divisit ineleganter; Hunc vos beatum; Duo Reges: constructio interrete. Immo alio genere; </p>

<p>De vacuitate doloris eadem sententia erit. Nonne igitur tibi videntur, inquit, mala? </p>

<h2>An vero displicuit ea, quae tributa est animi virtutibus tanta praestantia?</h2>

<p>Sed videbimus. Tubulo putas dicere? An est aliquid, quod te sua sponte delectet? Non laboro, inquit, de nomine. Aliter enim explicari, quod quaeritur, non potest. Et nemo nimium beatus est; </p>

<p>Primum divisit ineleganter; Ecce aliud simile dissimile. Omnis enim est natura diligens sui. </p>

<p>Cyrenaici quidem non recusant; Videsne quam sit magna dissensio? Non est igitur voluptas bonum. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; </p>

<h3>Quid enim me prohiberet Epicureum esse, si probarem, quae ille diceret?</h3>

<p>Nos commodius agimus. Expressa vero in iis aetatibus, quae iam confirmatae sunt. Nam ista vestra: Si gravis, brevis; Quod ea non occurrentia fingunt, vincunt Aristonem; Velut ego nunc moveor. </p>

<p>Tubulo putas dicere? Certe, nisi voluptatem tanti aestimaretis. Zenonis est, inquam, hoc Stoici. Videsne, ut haec concinant? Nos vero, inquit ille; Quid censes in Latino fore? </p>

<p>Sin aliud quid voles, postea. Iam id ipsum absurdum, maximum malum neglegi. Haec para/doca illi, nos admirabilia dicamus. Magna laus. Quid turpius quam sapientis vitam ex insipientium sermone pendere? Sed mehercule pergrata mihi oratio tua. </p>

<p>Certe, nisi voluptatem tanti aestimaretis. Non igitur bene. Id enim natura desiderat. Inde igitur, inquit, ordiendum est. Certe, nisi voluptatem tanti aestimaretis. Sed quod proximum fuit non vidit. </p>' --container 'FooBarBazOutput' --position '69.4'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo35Bar63Baz' --container 'FooBarBazDynamicOutput' --position '10.31' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo35Bar75Baz' --output '<h1>Quod quidem iam fit etiam in Academia.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tanta vis admonitionis inest in locis; Vestri haec verecundius, illi fortasse constantius. Sullae consulatum? </p>

<h6>Aliena dixit in physicis nec ea ipsa, quae tibi probarentur;</h6>

<p>Immo videri fortasse. Certe, nisi voluptatem tanti aestimaretis. Iam contemni non poteris. Prodest, inquit, mihi eo esse animo. Bonum incolumis acies: misera caecitas. Occultum facinus esse potuerit, gaudebit; </p>

<p>At, si voluptas esset bonum, desideraret. Ita prorsus, inquam; Hic nihil fuit, quod quaereremus. Itaque contra est, ac dicitis; A mene tu? Quae duo sunt, unum facit. Zenonis est, inquam, hoc Stoici. </p>

<p>Nam de isto magna dissensio est. Illi enim inter se dissentiunt. </p>

<p>Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; Sequitur disserendi ratio cognitioque naturae; Hic nihil fuit, quod quaereremus. Duo Reges: constructio interrete. Duo enim genera quae erant, fecit tria. Equidem, sed audistine modo de Carneade? </p>

<h3>Dici enim nihil potest verius.</h3>

<p>Memini vero, inquam; Nonne igitur tibi videntur, inquit, mala? Sed in rebus apertissimis nimium longi sumus. Satis est ad hoc responsum. </p>

<p>Si mala non sunt, iacet omnis ratio Peripateticorum. In schola desinis. </p>

<h2>Consequentia exquirere, quoad sit id, quod volumus, effectum.</h2>

<p>Nemo igitur esse beatus potest. Quare conare, quaeso. </p>

<h4>Ut placet, inquit, etsi enim illud erat aptius, aequum cuique concedere.</h4>

<p>Sed haec in pueris; Aliter enim nosmet ipsos nosse non possumus. Quid est igitur, inquit, quod requiras? Bonum integritas corporis: misera debilitas. </p>

<h5>Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse;</h5>

<p>Expectoque quid ad id, quod quaerebam, respondeas. Maximus dolor, inquit, brevis est. Multoque hoc melius nos veriusque quam Stoici. Eademne, quae restincta siti? Nunc agendum est subtilius. </p>' --container 'FooBarBazOutput' --position '64.66'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo36Bar17Baz' --output '<h1>Cum id fugiunt, re eadem defendunt, quae Peripatetici, verba.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mehercule pergrata mihi oratio tua. Duo Reges: constructio interrete. De vacuitate doloris eadem sententia erit. Tubulo putas dicere? Philosophi autem in suis lectulis plerumque moriuntur. </p>

<h3>Etsi qui potest intellegi aut cogitari esse aliquod animal, quod se oderit?</h3>

<p>Quaerimus enim finem bonorum. Restinguet citius, si ardentem acceperit. </p>

<p>Frater et T. Scisse enim te quis coarguere possit? Erat enim Polemonis. Qui autem esse poteris, nisi te amor ipse ceperit? Utilitatis causa amicitia est quaesita. </p>

<p>Iam id ipsum absurdum, maximum malum neglegi. Quae autem natura suae primae institutionis oblita est? Ille incendat? Si longus, levis. Vide, quantum, inquam, fallare, Torquate. </p>

<p>Nunc omni virtuti vitium contrario nomine opponitur. Nunc omni virtuti vitium contrario nomine opponitur. Sit sane ista voluptas. Sed ad illum redeo. Omnia peccata paria dicitis. Age sane, inquam. Tum mihi Piso: Quid ergo? Immo videri fortasse. </p>

<p>Quae autem natura suae primae institutionis oblita est? Ut pulsi recurrant? Collige omnia, quae soletis: Praesidium amicorum. Non semper, inquam; Eadem nunc mea adversum te oratio est. </p>

<p>Age, inquies, ista parva sunt. Que Manilium, ab iisque M. Sullae consulatum? Summum ením bonum exposuit vacuitatem doloris; </p>

<p>Ille enim occurrentia nescio quae comminiscebatur; Nihilo beatiorem esse Metellum quam Regulum. Nihil illinc huc pervenit. Facete M. Non laboro, inquit, de nomine. </p>

<h2>Nos quidem Virtutes sic natae sumus, ut tibi serviremus, aliud negotii nihil habemus.</h2>

<p>Ita ne hoc quidem modo paria peccata sunt. Quo modo autem philosophus loquitur? Quae ista amicitia est? </p>

<p>Quae sequuntur igitur? Quid censes in Latino fore? Quo tandem modo? </p>' --container 'FooBarBazOutput' --position '71.45'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo36Bar61Baz' --output '<h1>Dic in quovis conventu te omnia facere, ne doleas.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bonum liberi: misera orbitas. Qui est in parvis malis. Tanta vis admonitionis inest in locis; Duo Reges: constructio interrete. Laboro autem non sine causa; Quam illa ardentis amores excitaret sui! Cur tandem? Scaevolam M. At iam decimum annum in spelunca iacet. </p>

<p>Quae similitudo in genere etiam humano apparet. Aliter enim nosmet ipsos nosse non possumus. Aufert enim sensus actionemque tollit omnem. Itaque hic ipse iam pridem est reiectus; </p>

<p>Si longus, levis; Quid ad utilitatem tantae pecuniae? Et quod est munus, quod opus sapientiae? Haec quo modo conveniant, non sane intellego. </p>

<h2>Nam, ut sint illa vendibiliora, haec uberiora certe sunt.</h2>

<p>Philosophi autem in suis lectulis plerumque moriuntur. Istic sum, inquit. Itaque his sapiens semper vacabit. At ille pellit, qui permulcet sensum voluptate. Haec igitur Epicuri non probo, inquam. Non laboro, inquit, de nomine. Istam voluptatem, inquit, Epicurus ignorat? Sed haec in pueris; </p>

<h3>Illum mallem levares, quo optimum atque humanissimum virum, Cn.</h3>

<p>Tum ille: Ain tandem? Nummus in Croesi divitiis obscuratur, pars est tamen divitiarum. Nihil opus est exemplis hoc facere longius. Sint ista Graecorum; </p>

<p>Quonam, inquit, modo? Nunc agendum est subtilius. Nulla erit controversia. Itaque his sapiens semper vacabit. Sic enim censent, oportunitatis esse beate vivere. Illa tamen simplicia, vestra versuta. Quare ad ea primum, si videtur; </p>

<p>Inde igitur, inquit, ordiendum est. Cui Tubuli nomen odio non est? Sed tu istuc dixti bene Latine, parum plane. Nihilo beatiorem esse Metellum quam Regulum. Sed plane dicit quod intellegit. Non igitur bene. </p>

<h4>Quare attende, quaeso.</h4>

<p>Hoc simile tandem est? Quamquam ab iis philosophiam et omnes ingenuas disciplinas habemus; Videamus igitur sententias eorum, tum ad verba redeamus. Certe, nisi voluptatem tanti aestimaretis. Sed ne, dum huic obsequor, vobis molestus sim. Collige omnia, quae soletis: Praesidium amicorum. Tecum optime, deinde etiam cum mediocri amico. Bonum valitudo: miser morbus. </p>

<p>Non risu potius quam oratione eiciendum? Qualem igitur hominem natura inchoavit? Quam ob rem tandem, inquit, non satisfacit? Prioris generis est docilitas, memoria; Tum Piso: Quoniam igitur aliquid omnes, quid Lucius noster? </p>

<p>Quo tandem modo? Qui non moveatur et offensione turpitudinis et comprobatione honestatis? Post enim Chrysippum eum non sane est disputatum. Tanta vis admonitionis inest in locis; </p>' --container 'FooBarBazOutput' --position '89.71'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo37Bar47Baz' --container 'FooBarBazDynamicOutput' --position '30.51' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo37Bar49Baz' --output '<h1>Fortemne possumus dicere eundem illum Torquatum?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Si longus, levis; Idem adhuc; Quae quidem sapientes sequuntur duce natura tamquam videntes; Hoc loco tenere se Triarius non potuit. Addidisti ad extremum etiam indoctum fuisse. Zenonis est, inquam, hoc Stoici. Duo Reges: constructio interrete. </p>

<p>Quare ad ea primum, si videtur; Isto modo ne improbos quidem, si essent boni viri. Illa tamen simplicia, vestra versuta. Haec dicuntur inconstantissime. Suo genere perveniant ad extremum; Quis istud possit, inquit, negare? </p>

<p>Quid autem habent admirationis, cum prope accesseris? Quid enim? Id est enim, de quo quaerimus. Memini vero, inquam; </p>

<h5>Dat enim intervalla et relaxat.</h5>

<p>Immo alio genere; Quis Aristidem non mortuum diligit? Ergo ita: non posse honeste vivi, nisi honeste vivatur? Tum Torquatus: Prorsus, inquit, assentior; De illis, cum volemus. Quae cum essent dicta, discessimus. </p>

<p>Ut aliquid scire se gaudeant? Qualem igitur hominem natura inchoavit? Quid, quod res alia tota est? Sed fortuna fortis; Omnia contraria, quos etiam insanos esse vultis. Videsne, ut haec concinant? Quae duo sunt, unum facit. Ut aliquid scire se gaudeant? </p>

<h4>Quam ob rem tandem, inquit, non satisfacit?</h4>

<p>Hoc simile tandem est? Primum divisit ineleganter; Non est igitur voluptas bonum. Tum mihi Piso: Quid ergo? </p>

<h3>Qui ita affectus, beatum esse numquam probabis;</h3>

<p>Quis istud possit, inquit, negare? Moriatur, inquit. Si enim ad populum me vocas, eum. Qui est in parvis malis. Et nemo nimium beatus est; Ita multa dicunt, quae vix intellegam. Bonum liberi: misera orbitas. Immo videri fortasse. </p>

<h2>Sed eum qui audiebant, quoad poterant, defendebant sententiam suam.</h2>

<p>Ostendit pedes et pectus. Sine ea igitur iucunde negat posse se vivere? </p>

<p>Beatus sibi videtur esse moriens. Minime vero, inquit ille, consentit. Quid ergo attinet gloriose loqui, nisi constanter loquare? Ita nemo beato beatior. Nihil illinc huc pervenit. Hoc loco tenere se Triarius non potuit. </p>

<p>Dempta enim aeternitate nihilo beatior Iuppiter quam Epicurus; Sumenda potius quam expetenda. Cave putes quicquam esse verius. Primum divisit ineleganter; </p>' --container 'FooBarBazOutput' --position '28.2'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo37Bar56Baz' --output '<h1>Consequentia exquirere, quoad sit id, quod volumus, effectum.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; Aliud igitur esse censet gaudere, aliud non dolere. Quod cum dixissent, ille contra. Graece donan, Latine voluptatem vocant. Quantum Aristoxeni ingenium consumptum videmus in musicis? </p>

<p>Bestiarum vero nullum iudicium puto. Quid de Pythagora? Nonne igitur tibi videntur, inquit, mala? Tum mihi Piso: Quid ergo? Recte dicis; </p>

<p>De hominibus dici non necesse est. Venit ad extremum; Tollenda est atque extrahenda radicitus. Honesta oratio, Socratica, Platonis etiam. </p>

<p>Duo Reges: constructio interrete. Fortemne possumus dicere eundem illum Torquatum? Quamquam tu hanc copiosiorem etiam soles dicere. </p>

<p>Ad eas enim res ab Epicuro praecepta dantur. Conferam avum tuum Drusum cum C. Diodorus, eius auditor, adiungit ad honestatem vacuitatem doloris. Erit enim mecum, si tecum erit. Apparet statim, quae sint officia, quae actiones. An eiusdem modi? </p>

<p>Ratio quidem vestra sic cogit. Nihil sane. Laboro autem non sine causa; Quae similitudo in genere etiam humano apparet. Age sane, inquam. Eademne, quae restincta siti? </p>

<p>Nescio quo modo praetervolavit oratio. Sed quod proximum fuit non vidit. Velut ego nunc moveor. Nescio quo modo praetervolavit oratio. Cave putes quicquam esse verius. </p>

<h2>In eo enim positum est id, quod dicimus esse expetendum.</h2>

<p>Bestiarum vero nullum iudicium puto. Quae sequuntur igitur? Perge porro; Quodsi ipsam honestatem undique pertectam atque absolutam. Hunc vos beatum; Beatus sibi videtur esse moriens. Nam quid possumus facere melius? Nihil opus est exemplis hoc facere longius. Quamquam tu hanc copiosiorem etiam soles dicere. </p>

<h3>At modo dixeras nihil in istis rebus esse, quod interesset.</h3>

<p>Sint ista Graecorum; Quod iam a me expectare noli. </p>

<p>Videsne, ut haec concinant? Quis istud possit, inquit, negare? Nescio quo modo praetervolavit oratio. Conferam avum tuum Drusum cum C. Quid sequatur, quid repugnet, vident. Quae contraria sunt his, malane? </p>' --container 'FooBarBazOutput' --position '73.19'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo37Bar81Baz' --container 'FooBarBazDynamicOutput' --position '72.14' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo40Bar27Baz' --container 'FooBarBazDynamicOutput' --position '9.58' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo41Bar20Baz' --output '<h1>Idemne potest esse dies saepius, qui semel fuit?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quo tandem modo? Quae cum dixisset paulumque institisset, Quid est? Quid ergo attinet gloriose loqui, nisi constanter loquare? Duo Reges: constructio interrete. An eiusdem modi? Etiam beatissimum? </p>

<h2>Summus dolor plures dies manere non potest?</h2>

<p>Hoc simile tandem est? Multoque hoc melius nos veriusque quam Stoici. Quae diligentissime contra Aristonem dicuntur a Chryippo. Mihi enim satis est, ipsis non satis. Quod iam a me expectare noli. </p>

<p>Facillimum id quidem est, inquam. Bonum integritas corporis: misera debilitas. Quod cum dixissent, ille contra. Satis est ad hoc responsum. Nunc de hominis summo bono quaeritur; Nescio quo modo praetervolavit oratio. </p>

<h3>Nam adhuc, meo fortasse vitio, quid ego quaeram non perspicis.</h3>

<p>Cur iustitia laudatur? Mihi enim satis est, ipsis non satis. Sed potestne rerum maior esse dissensio? Quid ergo? Ut optime, secundum naturam affectum esse possit. Quibus ego vehementer assentior. </p>

<p>Tum mihi Piso: Quid ergo? Quis non odit sordidos, vanos, leves, futtiles? Summum ením bonum exposuit vacuitatem doloris; Quid ad utilitatem tantae pecuniae? </p>

<p>Summum ením bonum exposuit vacuitatem doloris; Quid vero? Quibusnam praeteritis? Ergo ita: non posse honeste vivi, nisi honeste vivatur? </p>

<h4>Deprehensus omnem poenam contemnet.</h4>

<p>An haec ab eo non dicuntur? Poterat autem inpune; Solum praeterea formosum, solum liberum, solum civem, stultost; Quae hic rei publicae vulnera inponebat, eadem ille sanabat. Si quicquam extra virtutem habeatur in bonis. </p>

<p>At coluit ipse amicitias. Omnia contraria, quos etiam insanos esse vultis. Sedulo, inquam, faciam. Nunc omni virtuti vitium contrario nomine opponitur. </p>

<p>Quare attende, quaeso. Non laboro, inquit, de nomine. Summus dolor plures dies manere non potest? Videamus animi partes, quarum est conspectus illustrior; </p>

<p>Non est igitur summum malum dolor. Graece donan, Latine voluptatem vocant. Facillimum id quidem est, inquam. Proclivi currit oratio. </p>' --container 'FooBarBazOutput' --position '84.56'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo41Bar77Baz' --container 'FooBarBazDynamicOutput' --position '50.2' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo47Bar32Baz' --container 'FooBarBazDynamicOutput' --position '18.64' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo48Bar27Baz' --container 'FooBarBazDynamicOutput' --position '31.75' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo48Bar43Baz' --container 'FooBarBazDynamicOutput' --position '45.22' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo48Bar59Baz' --output '<h1>Semper enim ita adsumit aliquid, ut ea, quae prima dederit, non deserat.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Audeo dicere, inquit. Tria genera bonorum; Quae cum dixisset paulumque institisset, Quid est? In schola desinis. </p>

<p>Vide, quantum, inquam, fallare, Torquate. Suo genere perveniant ad extremum; Virtutis, magnitudinis animi, patientiae, fortitudinis fomentis dolor mitigari solet. Videamus animi partes, quarum est conspectus illustrior; Nam quid possumus facere melius? Quare conare, quaeso. Est, ut dicis, inquit; Sic enim censent, oportunitatis esse beate vivere. </p>

<p>Tum Torquatus: Prorsus, inquit, assentior; Istam voluptatem, inquit, Epicurus ignorat? Egone non intellego, quid sit don Graece, Latine voluptas? Quis negat? </p>

<h2>Sin tantum modo ad indicia veteris memoriae cognoscenda, curiosorum.</h2>

<p>Duo Reges: constructio interrete. Zenonis est, inquam, hoc Stoici. Itaque hic ipse iam pridem est reiectus; Beatus sibi videtur esse moriens. Quippe: habes enim a rhetoribus; </p>

<p>Tenent mordicus. Quare conare, quaeso. Occultum facinus esse potuerit, gaudebit; Quodsi ipsam honestatem undique pertectam atque absolutam. Respondeat totidem verbis. Deinde disputat, quod cuiusque generis animantium statui deceat extremum. </p>

<p>Putabam equidem satis, inquit, me dixisse. Sed fortuna fortis; Quid dubitas igitur mutare principia naturae? Quod vestri non item. Haec para/doca illi, nos admirabilia dicamus. Ac tamen hic mallet non dolere. </p>

<p>Eam stabilem appellas. Efficiens dici potest. Quorum sine causa fieri nihil putandum est. Nos commodius agimus. Nos commodius agimus. </p>

<p>Suo genere perveniant ad extremum; Itaque his sapiens semper vacabit. </p>

<h3>Sed tamen omne, quod de re bona dilucide dicitur, mihi praeclare dici videtur.</h3>

<p>Proclivi currit oratio. Paria sunt igitur. Vide, quaeso, rectumne sit. Non est igitur summum malum dolor. Memini vero, inquam; </p>

<p>Quorum sine causa fieri nihil putandum est. Duarum enim vitarum nobis erunt instituta capienda. Nunc agendum est subtilius. </p>' --container 'FooBarBazOutput' --position '98.98'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo49Bar71Baz' --output '<h1>Virtutis, magnitudinis animi, patientiae, fortitudinis fomentis dolor mitigari solet.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Prodest, inquit, mihi eo esse animo. Cave putes quicquam esse verius. Non semper, inquam; Duo Reges: constructio interrete. Non autem hoc: igitur ne illud quidem. Mihi enim satis est, ipsis non satis. Ego vero isti, inquam, permitto. </p>

<h3>Quarum ambarum rerum cum medicinam pollicetur, luxuriae licentiam pollicetur.</h3>

<p>Quid de Pythagora? De illis, cum volemus. Minime vero istorum quidem, inquit. Non semper, inquam; Omnia contraria, quos etiam insanos esse vultis. Ea possunt paria non esse. </p>

<h2>Scisse enim te quis coarguere possit?</h2>

<p>Quis enim redargueret? Certe, nisi voluptatem tanti aestimaretis. Mihi enim erit isdem istis fortasse iam utendum. Quid igitur, inquit, eos responsuros putas? Expectoque quid ad id, quod quaerebam, respondeas. Atqui reperies, inquit, in hoc quidem pertinacem; </p>

<p>Quae quidem vel cum periculo est quaerenda vobis; Ita nemo beato beatior. Quid Zeno? Quis istud possit, inquit, negare? At eum nihili facit; Dat enim intervalla et relaxat. </p>

<h4>An tu me de L.</h4>

<p>Atqui reperies, inquit, in hoc quidem pertinacem; Et quod est munus, quod opus sapientiae? Sit enim idem caecus, debilis. Negare non possum. </p>

<p>Quae ista amicitia est? Equidem e Cn. Quod quidem iam fit etiam in Academia. </p>

<p>An potest cupiditas finiri? Qui ita affectus, beatum esse numquam probabis; Hoc loco tenere se Triarius non potuit. Conferam avum tuum Drusum cum C. </p>

<p>Qui est in parvis malis. Hoc ipsum elegantius poni meliusque potuit. Praeteritis, inquit, gaudeo. Sit sane ista voluptas. </p>

<h5>Tum Torquatus: Prorsus, inquit, assentior;</h5>

<p>Tollenda est atque extrahenda radicitus. Illa tamen simplicia, vestra versuta. De quibus cupio scire quid sentias. Quare attende, quaeso. De vacuitate doloris eadem sententia erit. </p>

<p>A mene tu? At multis malis affectus. Graece donan, Latine voluptatem vocant. Iam contemni non poteris. Eaedem res maneant alio modo. Aliter enim nosmet ipsos nosse non possumus. Que Manilium, ab iisque M. </p>' --container 'FooBarBazOutput' --position '75.23'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo50Bar20Baz' --container 'FooBarBazDynamicOutput' --position '88.72' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo51Bar64Baz' --container 'FooBarBazDynamicOutput' --position '97.56' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo52Bar27Baz' --output '<h1>Facile est hoc cernere in primis puerorum aetatulis.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Illi enim inter se dissentiunt. Stoici scilicet. Idemque diviserunt naturam hominis in animum et corpus. Quamquam te quidem video minime esse deterritum. Quae duo sunt, unum facit. At iam decimum annum in spelunca iacet. </p>

<p>Non semper, inquam; Omnes enim iucundum motum, quo sensus hilaretur. Tu vero, inquam, ducas licet, si sequetur; </p>

<p>Negat esse eam, inquit, propter se expetendam. Sed hoc sane concedamus. Habent enim et bene longam et satis litigiosam disputationem. Philosophi autem in suis lectulis plerumque moriuntur. </p>

<h3>Duo enim genera quae erant, fecit tria.</h3>

<p>Nihil illinc huc pervenit. Sint modo partes vitae beatae. Quis istum dolorem timet? Tum Torquatus: Prorsus, inquit, assentior; An est aliquid, quod te sua sponte delectet? Quid de Platone aut de Democrito loquar? </p>

<p>Sed haec nihil sane ad rem; Expectoque quid ad id, quod quaerebam, respondeas. </p>

<p>Suo genere perveniant ad extremum; In schola desinis. </p>

<p>Non dolere, inquam, istud quam vim habeat postea videro; Sed fac ista esse non inportuna; Prave, nequiter, turpiter cenabat; Tanta vis admonitionis inest in locis; In schola desinis. Tanta vis admonitionis inest in locis; Cum id fugiunt, re eadem defendunt, quae Peripatetici, verba. </p>

<p>Negat enim summo bono afferre incrementum diem. Ratio enim nostra consentit, pugnat oratio. Sic consequentibus vestris sublatis prima tolluntur. Mihi quidem Antiochum, quem audis, satis belle videris attendere. Prioris generis est docilitas, memoria; </p>

<p>Sed haec in pueris; Confecta res esset. Duo Reges: constructio interrete. Prave, nequiter, turpiter cenabat; Aliter homines, aliter philosophos loqui putas oportere? Quasi ego id curem, quid ille aiat aut neget. Sed nimis multa. </p>

<h2>Nos commodius agimus.</h2>

<p>Beatus sibi videtur esse moriens. Itaque his sapiens semper vacabit. Unum est sine dolore esse, alterum cum voluptate. Haec dicuntur inconstantissime. Mihi, inquam, qui te id ipsum rogavi? Quid igitur, inquit, eos responsuros putas? </p>' --container 'FooBarBazOutput' --position '8.8'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo52Bar66Baz' --container 'FooBarBazDynamicOutput' --position '51.4' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo54Bar63Baz' --output '<h1>Est enim effectrix multarum et magnarum voluptatum.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Haec quo modo conveniant, non sane intellego. Duo Reges: constructio interrete. Non risu potius quam oratione eiciendum? Multoque hoc melius nos veriusque quam Stoici. Duo enim genera quae erant, fecit tria. </p>

<p>Quae contraria sunt his, malane? At enim hic etiam dolore. Sed ad haec, nisi molestum est, habeo quae velim. Teneo, inquit, finem illi videri nihil dolere. Sequitur disserendi ratio cognitioque naturae; Quis istud possit, inquit, negare? </p>

<p>Prioris generis est docilitas, memoria; Tria genera bonorum; Pauca mutat vel plura sane; Quae cum dixisset, finem ille. Suo enim quisque studio maxime ducitur. Quae cum essent dicta, discessimus. </p>

<p>Quid iudicant sensus? Sit enim idem caecus, debilis. Ille incendat? Sint modo partes vitae beatae. </p>

<p>Primum divisit ineleganter; Tubulo putas dicere? Qua tu etiam inprudens utebare non numquam. Egone quaeris, inquit, quid sentiam? Sed ad rem redeamus; Maximus dolor, inquit, brevis est. </p>

<h4>Piso, familiaris noster, et alia multa et hoc loco Stoicos irridebat: Quid enim?</h4>

<p>Refert tamen, quo modo. Quorum altera prosunt, nocent altera. Ita multa dicunt, quae vix intellegam. </p>

<p>Si quae forte-possumus. Quis Aristidem non mortuum diligit? Quo tandem modo? Mihi enim satis est, ipsis non satis. Negat enim summo bono afferre incrementum diem. Audeo dicere, inquit. Istam voluptatem, inquit, Epicurus ignorat? </p>

<h3>Nunc ita separantur, ut disiuncta sint, quo nihil potest esse perversius.</h3>

<p>Indicant pueri, in quibus ut in speculis natura cernitur. Immo alio genere; Quis enim redargueret? Et harum quidem rerum facilis est et expedita distinctio. Iam enim adesse poterit. </p>

<p>Nihil sane. Nos vero, inquit ille; Sint modo partes vitae beatae. Nihil sane. Idemne, quod iucunde? Mihi enim satis est, ipsis non satis. Sed virtutem ipsam inchoavit, nihil amplius. Poterat autem inpune; </p>

<h2>Hoc tu nunc in illo probas.</h2>

<p>Maximus dolor, inquit, brevis est. Nam de isto magna dissensio est. Facillimum id quidem est, inquam. Vide, quantum, inquam, fallare, Torquate. Quare attende, quaeso. Ut optime, secundum naturam affectum esse possit. Sed haec omittamus; </p>' --container 'FooBarBazOutput' --position '85.56'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo54Bar74Baz' --container 'FooBarBazDynamicOutput' --position '40.86' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo56Bar92Baz' --output '<h1>Suo genere perveniant ad extremum;</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Omnes enim iucundum motum, quo sensus hilaretur. Quod autem principium officii quaerunt, melius quam Pyrrho; Invidiosum nomen est, infame, suspectum. Traditur, inquit, ab Epicuro ratio neglegendi doloris. </p>

<p>Quare attende, quaeso. Nam, ut sint illa vendibiliora, haec uberiora certe sunt. Respondent extrema primis, media utrisque, omnia omnibus. Aliter enim nosmet ipsos nosse non possumus. </p>

<p>Quod vestri non item. Sint ista Graecorum; Hoc sic expositum dissimile est superiori. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; </p>

<p>Istic sum, inquit. Memini vero, inquam; Neque solum ea communia, verum etiam paria esse dixerunt. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; Traditur, inquit, ab Epicuro ratio neglegendi doloris. Nescio quo modo praetervolavit oratio. </p>

<p>Sine ea igitur iucunde negat posse se vivere? Numquam facies. Nos cum te, M. Explanetur igitur. At hoc in eo M. Quod totum contra est. </p>

<p>Habes, inquam, Cato, formam eorum, de quibus loquor, philosophorum. Easdemne res? Apparet statim, quae sint officia, quae actiones. Obsecro, inquit, Torquate, haec dicit Epicurus? </p>

<p>At hoc in eo M. In schola desinis. Nos vero, inquit ille; Proclivi currit oratio. </p>

<p>Si quidem, inquit, tollerem, sed relinquo. Sequitur disserendi ratio cognitioque naturae; Inde igitur, inquit, ordiendum est. Polycratem Samium felicem appellabant. Ea possunt paria non esse. Certe, nisi voluptatem tanti aestimaretis. Bonum integritas corporis: misera debilitas. Sed ad illum redeo. </p>

<p>Duo Reges: constructio interrete. Honesta oratio, Socratica, Platonis etiam. Audeo dicere, inquit. Iam id ipsum absurdum, maximum malum neglegi. </p>

<h2>Quid ad utilitatem tantae pecuniae?</h2>

<p>Hos contra singulos dici est melius. Recte, inquit, intellegis. Sed tamen intellego quid velit. Graece donan, Latine voluptatem vocant. </p>' --container 'FooBarBazOutput' --position '83.15'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo57Bar54Baz' --container 'FooBarBazDynamicOutput' --position '18.1' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo61Bar11Baz' --output '<h1>Sed ea mala virtuti magnitudine obruebantur.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita prorsus, inquam; Confecta res esset. Eaedem res maneant alio modo. Quid iudicant sensus? </p>

<p>Quis hoc dicit? Illa tamen simplicia, vestra versuta. Quis non odit sordidos, vanos, leves, futtiles? Quis istud, quaeso, nesciebat? </p>

<p>Quis istum dolorem timet? Hic ambiguo ludimur. At hoc in eo M. Hic ambiguo ludimur. Suo enim quisque studio maxime ducitur. </p>

<p>Videamus animi partes, quarum est conspectus illustrior; At multis se probavit. Sed ea mala virtuti magnitudine obruebantur. </p>

<p>An vero, inquit, quisquam potest probare, quod perceptfum, quod. Sullae consulatum? Proclivi currit oratio. Tum Triarius: Posthac quidem, inquit, audacius. Esse enim quam vellet iniquus iustus poterat inpune. Quamquam te quidem video minime esse deterritum. </p>

<p>Non est igitur voluptas bonum. Sed in rebus apertissimis nimium longi sumus. Moriatur, inquit. Itaque ab his ordiamur. </p>

<h2>Res enim se praeclare habebat, et quidem in utraque parte.</h2>

<p>Deprehensus omnem poenam contemnet. Sed ad rem redeamus; Quis istud possit, inquit, negare? Quae est igitur causa istarum angustiarum? Ubi ut eam caperet aut quando? Quis est tam dissimile homini. </p>

<p>Summae mihi videtur inscitiae. Duo Reges: constructio interrete. Prave, nequiter, turpiter cenabat; Ego vero isti, inquam, permitto. Quare attende, quaeso. Suo genere perveniant ad extremum; </p>

<h3>Illa argumenta propria videamus, cur omnia sint paria peccata.</h3>

<p>Si quidem, inquit, tollerem, sed relinquo. Sed quod proximum fuit non vidit. Summus dolor plures dies manere non potest? Non laboro, inquit, de nomine. Summum a vobis bonum voluptas dicitur. Sed virtutem ipsam inchoavit, nihil amplius. </p>

<p>Non potes, nisi retexueris illa. Pugnant Stoici cum Peripateticis. Quid igitur, inquit, eos responsuros putas? </p>' --container 'FooBarBazOutput' --position '2.32'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo61Bar66Baz' --container 'FooBarBazDynamicOutput' --position '12.79' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo61Bar96Baz' --output '<h1>Est autem etiam actio quaedam corporis, quae motus et status naturae congruentis tenet;</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Idemque diviserunt naturam hominis in animum et corpus. Hoc est non dividere, sed frangere. Hic ambiguo ludimur. Duo Reges: constructio interrete. Si id dicis, vicimus. </p>

<h2>Sint modo partes vitae beatae.</h2>

<p>Tum Torquatus: Prorsus, inquit, assentior; At multis malis affectus. Esse enim, nisi eris, non potes. Vide, quantum, inquam, fallare, Torquate. Aliud igitur esse censet gaudere, aliud non dolere. Ergo hoc quidem apparet, nos ad agendum esse natos. </p>

<p>Non igitur bene. Itaque ad tempus ad Pisonem omnes. In schola desinis. Si id dicis, vicimus. Mihi, inquam, qui te id ipsum rogavi? Primum in nostrane potestate est, quid meminerimus? </p>

<p>Esse enim quam vellet iniquus iustus poterat inpune. Prodest, inquit, mihi eo esse animo. Inquit, dasne adolescenti veniam? Id est enim, de quo quaerimus. Nos commodius agimus. </p>

<h3>Non autem hoc: igitur ne illud quidem.</h3>

<p>Non igitur bene. Nihil opus est exemplis hoc facere longius. Tria genera bonorum; Quae quidem vel cum periculo est quaerenda vobis; Haec dicuntur inconstantissime. </p>

<p>Quis non odit sordidos, vanos, leves, futtiles? Nihil enim hoc differt. Quae similitudo in genere etiam humano apparet. Iam id ipsum absurdum, maximum malum neglegi. Eademne, quae restincta siti? Restatis igitur vos; </p>

<h5>De malis autem et bonis ab iis animalibus, quae nondum depravata sint, ait optime iudicari.</h5>

<p>Praeteritis, inquit, gaudeo. Omnis enim est natura diligens sui. Non risu potius quam oratione eiciendum? Conferam avum tuum Drusum cum C. </p>

<p>Tum mihi Piso: Quid ergo? Ille incendat? Frater et T. </p>

<h4>Ut in geometria, prima si dederis, danda sunt omnia.</h4>

<p>Sed virtutem ipsam inchoavit, nihil amplius. Hoc sic expositum dissimile est superiori. Quorum sine causa fieri nihil putandum est. Iam in altera philosophiae parte. Nos paucis ad haec additis finem faciamus aliquando; Quia dolori non voluptas contraria est, sed doloris privatio. </p>

<p>Quibus ego vehementer assentior. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; An tu me de L. Frater et T. Gerendus est mos, modo recte sentiat. Sed haec nihil sane ad rem; </p>' --container 'FooBarBazOutput' --position '50.24'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo62Bar82Baz' --output '<h1>Idque testamento cavebit is, qui nobis quasi oraculum ediderit nihil post mortem ad nos pertinere?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Rationis enim perfectio est virtus; Et quod est munus, quod opus sapientiae? Conferam avum tuum Drusum cum C. Quo tandem modo? Tibi hoc incredibile, quod beatissimum. Duo Reges: constructio interrete. Quid vero? Vide, quaeso, rectumne sit. </p>

<p>Certe non potest. Velut ego nunc moveor. Sic enim censent, oportunitatis esse beate vivere. Odium autem et invidiam facile vitabis. </p>

<p>Sed ad illum redeo. Sit enim idem caecus, debilis. Sed haec omittamus; Ita prorsus, inquam; </p>

<h3>Nonne videmus quanta perturbatio rerum omnium consequatur, quanta confusio?</h3>

<p>Quorum sine causa fieri nihil putandum est. Sedulo, inquam, faciam. Cur tantas regiones barbarorum pedibus obiit, tot maria transmisit? Quippe: habes enim a rhetoribus; </p>

<h4>Diodorus, eius auditor, adiungit ad honestatem vacuitatem doloris.</h4>

<p>Haec para/doca illi, nos admirabilia dicamus. Sed virtutem ipsam inchoavit, nihil amplius. Quae similitudo in genere etiam humano apparet. Tu quidem reddes; Eam stabilem appellas. Sit enim idem caecus, debilis. Non est igitur summum malum dolor. </p>

<p>Disserendi artem nullam habuit. Ille enim occurrentia nescio quae comminiscebatur; </p>

<p>Ut optime, secundum naturam affectum esse possit. Poterat autem inpune; Si longus, levis. </p>

<p>Quis istud possit, inquit, negare? Avaritiamne minuis? De illis, cum volemus. Et ille ridens: Video, inquit, quid agas; Tum mihi Piso: Quid ergo? Ita nemo beato beatior. Sed plane dicit quod intellegit. Ut aliquid scire se gaudeant? </p>

<p>Satis est ad hoc responsum. Efficiens dici potest. </p>

<h2>Ita graviter et severe voluptatem secrevit a bono.</h2>

<p>Ut proverbia non nulla veriora sint quam vestra dogmata. Haec et tu ita posuisti, et verba vestra sunt. An tu me de L. </p>' --container 'FooBarBazOutput' --position '75.11'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo63Bar72Baz' --output '<h1>Gloriosa ostentatio in constituendo summo bono.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tum Triarius: Posthac quidem, inquit, audacius. Ait enim se, si uratur, Quam hoc suave! dicturum. Cur, nisi quod turpis oratio est? Duo Reges: constructio interrete. </p>

<p>Gloriosa ostentatio in constituendo summo bono. Bestiarum vero nullum iudicium puto. Nam de isto magna dissensio est. Si quicquam extra virtutem habeatur in bonis. Quod iam a me expectare noli. Quid ergo? </p>

<p>Illis videtur, qui illud non dubitant bonum dicere -; At eum nihili facit; Nunc omni virtuti vitium contrario nomine opponitur. At iste non dolendi status non vocatur voluptas. </p>

<h2>Quem ad modum quis ambulet, sedeat, qui ductus oris, qui vultus in quoque sit?</h2>

<p>Erat enim res aperta. Summus dolor plures dies manere non potest? Confecta res esset. Nihil opus est exemplis hoc facere longius. Aliter homines, aliter philosophos loqui putas oportere? Universa enim illorum ratione cum tota vestra confligendum puto. Primum divisit ineleganter; Quo modo autem optimum, si bonum praeterea nullum est? </p>

<p>Sed videbimus. Quae duo sunt, unum facit. </p>

<p>Sed tamen intellego quid velit. Et quod est munus, quod opus sapientiae? Venit ad extremum; Nonne igitur tibi videntur, inquit, mala? </p>

<p>Quacumque enim ingredimur, in aliqua historia vestigium ponimus. Sed quid sentiat, non videtis. Si mala non sunt, iacet omnis ratio Peripateticorum. Profectus in exilium Tubulus statim nec respondere ausus; </p>

<h3>Quantum Aristoxeni ingenium consumptum videmus in musicis?</h3>

<p>Eam tum adesse, cum dolor omnis absit; Non autem hoc: igitur ne illud quidem. Certe non potest. Itaque his sapiens semper vacabit. Ne amores quidem sanctos a sapiente alienos esse arbitrantur. Sed virtutem ipsam inchoavit, nihil amplius. </p>

<p>Eam stabilem appellas. Quare conare, quaeso. Si quidem, inquit, tollerem, sed relinquo. Quid enim est a Chrysippo praetermissum in Stoicis? </p>

<p>Ostendit pedes et pectus. Reguli reiciendam; Collatio igitur ista te nihil iuvat. Poterat autem inpune; </p>' --container 'FooBarBazOutput' --position '32.66'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo65Bar39Baz' --container 'FooBarBazDynamicOutput' --position '77.8' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo66Bar33Baz' --container 'FooBarBazDynamicOutput' --position '65.43' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo66Bar45Baz' --output '<h1>Maximas vero virtutes iacere omnis necesse est voluptate dominante.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praeclare hoc quidem. Negare non possum. Aperiendum est igitur, quid sit voluptas; Duo Reges: constructio interrete. An est aliquid, quod te sua sponte delectet? Ad eas enim res ab Epicuro praecepta dantur. Istic sum, inquit. Qui convenit? </p>

<p>Illud non continuo, ut aeque incontentae. Cur id non ita fit? Immo videri fortasse. Est enim effectrix multarum et magnarum voluptatum. Hoc sic expositum dissimile est superiori. </p>

<p>Ut id aliis narrare gestiant? Negare non possum. At multis se probavit. Haec dicuntur inconstantissime. Simus igitur contenti his. Huius, Lyco, oratione locuples, rebus ipsis ielunior. </p>

<p>Aliter enim nosmet ipsos nosse non possumus. Sed residamus, inquit, si placet. Hic ambiguo ludimur. Sed in rebus apertissimis nimium longi sumus. Haeret in salebra. Facete M. Si quae forte-possumus. Aliter enim explicari, quod quaeritur, non potest. </p>

<p>Dat enim intervalla et relaxat. Putabam equidem satis, inquit, me dixisse. Estne, quaeso, inquam, sitienti in bibendo voluptas? Sed plane dicit quod intellegit. Quodsi ipsam honestatem undique pertectam atque absolutam. Sedulo, inquam, faciam. Si quicquam extra virtutem habeatur in bonis. </p>

<h3>Aliter autem vobis placet.</h3>

<p>Ne in odium veniam, si amicum destitero tueri. Non igitur bene. Dat enim intervalla et relaxat. Tubulo putas dicere? </p>

<p>Itaque fecimus. Eiuro, inquit adridens, iniquum, hac quidem de re; Qua tu etiam inprudens utebare non numquam. Non autem hoc: igitur ne illud quidem. Sit enim idem caecus, debilis. Qui ita affectus, beatum esse numquam probabis; </p>

<p>Bonum incolumis acies: misera caecitas. Paria sunt igitur. Hoc sic expositum dissimile est superiori. Sed nimis multa. </p>

<p>Certe non potest. Videamus animi partes, quarum est conspectus illustrior; Nulla erit controversia. Quis istum dolorem timet? Quae sequuntur igitur? Et ille ridens: Video, inquit, quid agas; </p>

<h2>An hoc usque quaque, aliter in vita?</h2>

<p>Nihil sane. Et nemo nimium beatus est; Duarum enim vitarum nobis erunt instituta capienda. Teneo, inquit, finem illi videri nihil dolere. Ea possunt paria non esse. Respondeat totidem verbis. </p>' --container 'FooBarBazOutput' --position '36.83'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo70Bar84Baz' --output '<h1>Ita multo sanguine profuso in laetitia et in victoria est mortuus.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Gloriosa ostentatio in constituendo summo bono. Dici enim nihil potest verius. Moriatur, inquit. Duo Reges: constructio interrete. </p>

<p>Quorum altera prosunt, nocent altera. Tamen a proposito, inquam, aberramus. Aliter enim nosmet ipsos nosse non possumus. Age, inquies, ista parva sunt. Quae cum dixisset, finem ille. Proclivi currit oratio. </p>

<p>Honesta oratio, Socratica, Platonis etiam. Praeclarae mortes sunt imperatoriae; Illa argumenta propria videamus, cur omnia sint paria peccata. Dici enim nihil potest verius. Consequens enim est et post oritur, ut dixi. Quod totum contra est. </p>

<p>Sed fortuna fortis; Non semper, inquam; Aliter homines, aliter philosophos loqui putas oportere? Mihi enim satis est, ipsis non satis. </p>

<h2>Peccata paria.</h2>

<p>Suam denique cuique naturam esse ad vivendum ducem. Dici enim nihil potest verius. Hoc ipsum elegantius poni meliusque potuit. Haeret in salebra. Si longus, levis dictata sunt. </p>

<p>Si quae forte-possumus. Nunc haec primum fortasse audientis servire debemus. Primum in nostrane potestate est, quid meminerimus? </p>

<p>An eiusdem modi? Tanta vis admonitionis inest in locis; Eadem nunc mea adversum te oratio est. Cur id non ita fit? Memini me adesse P. Quod quidem iam fit etiam in Academia. Qui est in parvis malis. </p>

<p>Quacumque enim ingredimur, in aliqua historia vestigium ponimus. Sed nimis multa. Habent enim et bene longam et satis litigiosam disputationem. Nunc agendum est subtilius. Age sane, inquam. At eum nihili facit; </p>

<p>Disserendi artem nullam habuit. Sit enim idem caecus, debilis. Ergo, inquit, tibi Q. Fortemne possumus dicere eundem illum Torquatum? Hic nihil fuit, quod quaereremus. Quod equidem non reprehendo; </p>

<p>Eadem fortitudinis ratio reperietur. Quis istud, quaeso, nesciebat? Omnis enim est natura diligens sui. Tubulo putas dicere? Non potes, nisi retexueris illa. Equidem e Cn. Sed ea mala virtuti magnitudine obruebantur. </p>' --container 'FooBarBazOutput' --position '90.13'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo72Bar40Baz' --container 'FooBarBazDynamicOutput' --position '90.93' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo72Bar64Baz' --output '<h1>An haec ab eo non dicuntur?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod iam a me expectare noli. Quorum sine causa fieri nihil putandum est. Paria sunt igitur. Duo Reges: constructio interrete. Nihil enim hoc differt. </p>

<h3>Collatio igitur ista te nihil iuvat.</h3>

<p>Qui convenit? Nihilo beatiorem esse Metellum quam Regulum. Quid nunc honeste dicit? Sit enim idem caecus, debilis. Ego vero volo in virtute vim esse quam maximam; </p>

<h2>Sin aliud quid voles, postea.</h2>

<p>Quid ergo? Laboro autem non sine causa; Cur id non ita fit? Sed ille, ut dixi, vitiose. Is es profecto tu. Nummus in Croesi divitiis obscuratur, pars est tamen divitiarum. Sed ea mala virtuti magnitudine obruebantur. </p>

<p>Cyrenaici quidem non recusant; Nam quid possumus facere melius? Sed haec in pueris; Vide, quantum, inquam, fallare, Torquate. Num quid tale Democritus? </p>

<p>Ratio quidem vestra sic cogit. Prioris generis est docilitas, memoria; Nescio quo modo praetervolavit oratio. </p>

<p>Mihi enim satis est, ipsis non satis. Illa videamus, quae a te de amicitia dicta sunt. Multoque hoc melius nos veriusque quam Stoici. Nunc omni virtuti vitium contrario nomine opponitur. Sed quia studebat laudi et dignitati, multum in virtute processerat. Ut optime, secundum naturam affectum esse possit. </p>

<h5>Non autem hoc: igitur ne illud quidem.</h5>

<p>Quid est igitur, inquit, quod requiras? Quid me istud rogas? Aliter enim explicari, quod quaeritur, non potest. De hominibus dici non necesse est. Negat enim summo bono afferre incrementum diem. At, illa, ut vobis placet, partem quandam tuetur, reliquam deserit. </p>

<p>Hic nihil fuit, quod quaereremus. Sic enim censent, oportunitatis esse beate vivere. Nunc haec primum fortasse audientis servire debemus. Praeclarae mortes sunt imperatoriae; Ut aliquid scire se gaudeant? Ostendit pedes et pectus. Sed erat aequius Triarium aliquid de dissensione nostra iudicare. Facile est hoc cernere in primis puerorum aetatulis. </p>

<p>Deinde dolorem quem maximum? Summum ením bonum exposuit vacuitatem doloris; Sed ad illum redeo. Efficiens dici potest. Esse enim, nisi eris, non potes. Scrupulum, inquam, abeunti; Sit enim idem caecus, debilis. </p>

<h4>Quae similitudo in genere etiam humano apparet.</h4>

<p>Paria sunt igitur. Quod quidem iam fit etiam in Academia. Ad eas enim res ab Epicuro praecepta dantur. </p>' --container 'FooBarBazOutput' --position '60.56'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo73Bar39Baz' --container 'FooBarBazDynamicOutput' --position '2.3' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo74Bar16Baz' --output '<h1>Sunt enim prima elementa naturae, quibus auctis vírtutis quasi germen efficitur.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod equidem non reprehendo; Recte, inquit, intellegis. Urgent tamen et nihil remittunt. </p>

<p>Ipse Epicurus fortasse redderet, ut Sextus Peducaeus, Sex. Nihil enim iam habes, quod ad corpus referas; </p>

<p>Sullae consulatum? Stoici scilicet. Quid de Pythagora? Quae similitudo in genere etiam humano apparet. </p>

<p>Cur id non ita fit? Ea possunt paria non esse. Efficiens dici potest. </p>

<p>Quod totum contra est. Expectoque quid ad id, quod quaerebam, respondeas. Est, ut dicis, inquam. Quid adiuvas? Sed potestne rerum maior esse dissensio? Duo enim genera quae erant, fecit tria. </p>

<p>Verum hoc idem saepe faciamus. Nec vero alia sunt quaerenda contra Carneadeam illam sententiam. Est, ut dicis, inquit; Hoc non est positum in nostra actione. Et ille ridens: Video, inquit, quid agas; Aliter enim nosmet ipsos nosse non possumus. </p>

<h2>Duo Reges: constructio interrete.</h2>

<p>Nummus in Croesi divitiis obscuratur, pars est tamen divitiarum. Praeclare hoc quidem. Tum Quintus: Est plane, Piso, ut dicis, inquit. </p>

<p>Tum Torquatus: Prorsus, inquit, assentior; Hoc non est positum in nostra actione. </p>

<p>Quis enim redargueret? Sint modo partes vitae beatae. Non potes, nisi retexueris illa. Summum ením bonum exposuit vacuitatem doloris; Ut proverbia non nulla veriora sint quam vestra dogmata. Inde sermone vario sex illa a Dipylo stadia confecimus. </p>

<p>Quod autem principium officii quaerunt, melius quam Pyrrho; Quare conare, quaeso. Immo alio genere; Que Manilium, ab iisque M. Paria sunt igitur. </p>' --container 'FooBarBazOutput' --position '21'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo74Bar64Baz' --container 'FooBarBazDynamicOutput' --position '98.6' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo75Bar40Baz' --output '<h1>Itaque hic ipse iam pridem est reiectus;</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod autem principium officii quaerunt, melius quam Pyrrho; Eam stabilem appellas. Hoc tu nunc in illo probas. Sed residamus, inquit, si placet. Duo Reges: constructio interrete. Si verbum sequimur, primum longius verbum praepositum quam bonum. </p>

<p>Age sane, inquam. Sint ista Graecorum; Multoque hoc melius nos veriusque quam Stoici. Iam contemni non poteris. </p>

<h4>Quem Tiberina descensio festo illo die tanto gaudio affecit, quanto L.</h4>

<p>Minime vero, inquit ille, consentit. Qui non moveatur et offensione turpitudinis et comprobatione honestatis? Et ille ridens: Video, inquit, quid agas; Erit enim mecum, si tecum erit. Tecum optime, deinde etiam cum mediocri amico. Qui est in parvis malis. </p>

<h2>Quae hic rei publicae vulnera inponebat, eadem ille sanabat.</h2>

<p>Sed ne, dum huic obsequor, vobis molestus sim. Mihi enim satis est, ipsis non satis. Verum hoc idem saepe faciamus. Iam id ipsum absurdum, maximum malum neglegi. Sumenda potius quam expetenda. Rationis enim perfectio est virtus; </p>

<h5>Cave putes quicquam esse verius.</h5>

<p>Pauca mutat vel plura sane; Sed haec omittamus; Quae diligentissime contra Aristonem dicuntur a Chryippo. Quam si explicavisset, non tam haesitaret. </p>

<h3>Graecum enim hunc versum nostis omnes-: Suavis laborum est praeteritorum memoria.</h3>

<p>Ego vero volo in virtute vim esse quam maximam; Mihi enim satis est, ipsis non satis. Iam id ipsum absurdum, maximum malum neglegi. Quid de Pythagora? </p>

<p>Eam stabilem appellas. Invidiosum nomen est, infame, suspectum. Sint modo partes vitae beatae. Rationis enim perfectio est virtus; </p>

<p>Moriatur, inquit. Summum ením bonum exposuit vacuitatem doloris; Ita graviter et severe voluptatem secrevit a bono. Itaque his sapiens semper vacabit. Cave putes quicquam esse verius. Si longus, levis; </p>

<p>Nam ista vestra: Si gravis, brevis; Tecum optime, deinde etiam cum mediocri amico. Invidiosum nomen est, infame, suspectum. Hoc sic expositum dissimile est superiori. Hoc non est positum in nostra actione. Sed quod proximum fuit non vidit. Quae sequuntur igitur? </p>

<p>Quis negat? Tu quidem reddes; Putabam equidem satis, inquit, me dixisse. Falli igitur possumus. Nos cum te, M. Sic enim censent, oportunitatis esse beate vivere. </p>' --container 'FooBarBazOutput' --position '21.67'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo76Bar65Baz' --output '<h1>Immo vero, inquit, ad beatissime vivendum parum est, ad beate vero satis.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Age sane, inquam. Estne, quaeso, inquam, sitienti in bibendo voluptas? Pugnant Stoici cum Peripateticis. Duo Reges: constructio interrete. Aliter enim explicari, quod quaeritur, non potest. Ita multa dicunt, quae vix intellegam. </p>

<h2>Egone non intellego, quid sit don Graece, Latine voluptas?</h2>

<p>Ad eas enim res ab Epicuro praecepta dantur. Quantum Aristoxeni ingenium consumptum videmus in musicis? Nos vero, inquit ille; Sit sane ista voluptas. Tum mihi Piso: Quid ergo? Frater et T. </p>

<p>Occultum facinus esse potuerit, gaudebit; Quae cum dixisset, finem ille. Quis est tam dissimile homini. Simus igitur contenti his. Graece donan, Latine voluptatem vocant. Iam contemni non poteris. </p>

<p>Graece donan, Latine voluptatem vocant. Philosophi autem in suis lectulis plerumque moriuntur. Quod autem ratione actum est, id officium appellamus. Laboro autem non sine causa; Tollenda est atque extrahenda radicitus. Quo modo autem philosophus loquitur? Utilitatis causa amicitia est quaesita. Maximus dolor, inquit, brevis est. </p>

<p>Qui ita affectus, beatum esse numquam probabis; Aliter enim nosmet ipsos nosse non possumus. Quid ait Aristoteles reliquique Platonis alumni? Cur id non ita fit? Sed plane dicit quod intellegit. </p>

<p>Quid iudicant sensus? Conferam tecum, quam cuique verso rem subicias; Illud non continuo, ut aeque incontentae. Quamquam tu hanc copiosiorem etiam soles dicere. At, si voluptas esset bonum, desideraret. </p>

<p>Quid iudicant sensus? Ita credo. Suo enim quisque studio maxime ducitur. Venit ad extremum; Bonum incolumis acies: misera caecitas. Non risu potius quam oratione eiciendum? </p>

<h3>Ita credo.</h3>

<p>Memini vero, inquam; Quid sequatur, quid repugnet, vident. Eadem fortitudinis ratio reperietur. Dat enim intervalla et relaxat. Tum mihi Piso: Quid ergo? </p>

<h4>His similes sunt omnes, qui virtuti student levantur vitiis, levantur erroribus, nisi forte censes Ti.</h4>

<p>Sed plane dicit quod intellegit. Quo tandem modo? Respondeat totidem verbis. An potest cupiditas finiri? Cur haec eadem Democritus? </p>

<p>Istam voluptatem, inquit, Epicurus ignorat? Nemo igitur esse beatus potest. Praeclarae mortes sunt imperatoriae; Haec dicuntur fortasse ieiunius; Aliud igitur esse censet gaudere, aliud non dolere. Haeret in salebra. </p>' --container 'FooBarBazOutput' --position '98.73'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo76Bar68Baz' --container 'FooBarBazDynamicOutput' --position '91.4' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo77Bar41Baz' --output '<h1>An eiusdem modi?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A mene tu? Duo Reges: constructio interrete. </p>

<p>Sed quod proximum fuit non vidit. Habent enim et bene longam et satis litigiosam disputationem. Iam in altera philosophiae parte. Qua tu etiam inprudens utebare non numquam. Quae similitudo in genere etiam humano apparet. Quare attende, quaeso. </p>

<p>Quae cum dixisset paulumque institisset, Quid est? Indicant pueri, in quibus ut in speculis natura cernitur. Hanc quoque iucunditatem, si vis, transfer in animum; Restatis igitur vos; Ut id aliis narrare gestiant? </p>

<h2>Nullus est igitur cuiusquam dies natalis.</h2>

<p>Nobis aliter videtur, recte secusne, postea; Si longus, levis. Non autem hoc: igitur ne illud quidem. Prioris generis est docilitas, memoria; Tubulo putas dicere? Vestri haec verecundius, illi fortasse constantius. </p>

<p>Sint modo partes vitae beatae. Quo modo autem philosophus loquitur? Istam voluptatem perpetuam quis potest praestare sapienti? Tum Triarius: Posthac quidem, inquit, audacius. </p>

<p>Restinguet citius, si ardentem acceperit. Nam de isto magna dissensio est. Quae duo sunt, unum facit. Quod non faceret, si in voluptate summum bonum poneret. </p>

<p>Sint modo partes vitae beatae. Rationis enim perfectio est virtus; Ut aliquid scire se gaudeant? Verum hoc idem saepe faciamus. Dici enim nihil potest verius. In schola desinis. </p>

<p>Praeclarae mortes sunt imperatoriae; Qui est in parvis malis. Duo enim genera quae erant, fecit tria. Atqui reperies, inquit, in hoc quidem pertinacem; Quippe: habes enim a rhetoribus; Nam ante Aristippus, et ille melius. </p>

<p>Tum Torquatus: Prorsus, inquit, assentior; Deinde dolorem quem maximum? Dici enim nihil potest verius. Magna laus. Ita nemo beato beatior. </p>

<p>Itaque ab his ordiamur. Et nemo nimium beatus est; At enim hic etiam dolore. Ratio quidem vestra sic cogit. Tenent mordicus. Habent enim et bene longam et satis litigiosam disputationem. Quid enim possumus hoc agere divinius? </p>' --container 'FooBarBazOutput' --position '69.7'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo77Bar76Baz' --container 'FooBarBazDynamicOutput' --position '9.5' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo79Bar21Baz' --container 'FooBarBazDynamicOutput' --position '70.77' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo80Bar32Baz' --output '<h1>Tecum optime, deinde etiam cum mediocri amico.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quid sentiat, non videtis. Duo Reges: constructio interrete. Est, ut dicis, inquit; Nos cum te, M. Sed haec nihil sane ad rem; Sed quid sentiat, non videtis. Obsecro, inquit, Torquate, haec dicit Epicurus? </p>

<h4>Vide, ne etiam menses! nisi forte eum dicis, qui, simul atque arripuit, interficit.</h4>

<p>Hos contra singulos dici est melius. Oratio me istius philosophi non offendit; Sed hoc sane concedamus. Falli igitur possumus. Frater et T. Et nemo nimium beatus est; </p>

<p>Sed ille, ut dixi, vitiose. Quibusnam praeteritis? Eaedem res maneant alio modo. Quid sequatur, quid repugnet, vident. Nos commodius agimus. Ergo ita: non posse honeste vivi, nisi honeste vivatur? </p>

<p>Ita fit cum gravior, tum etiam splendidior oratio. Illud non continuo, ut aeque incontentae. Nulla erit controversia. Sed tamen intellego quid velit. Sed haec omittamus; Huius ego nunc auctoritatem sequens idem faciam. </p>

<h1>Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur?</h1>

<p>Certe non potest. Bonum incolumis acies: misera caecitas. Sed virtutem ipsam inchoavit, nihil amplius. Efficiens dici potest. Quis est tam dissimile homini. Negat enim summo bono afferre incrementum diem. Sed residamus, inquit, si placet. Cui Tubuli nomen odio non est? </p>

<h3>Sed quod proximum fuit non vidit.</h3>

<p>Cur id non ita fit? Qui ita affectus, beatum esse numquam probabis; Et ille ridens: Video, inquit, quid agas; Hanc quoque iucunditatem, si vis, transfer in animum; Nihil illinc huc pervenit. Contemnit enim disserendi elegantiam, confuse loquitur. Praeteritis, inquit, gaudeo. Graccho, eius fere, aequalí? </p>

<h5>Ita ne hoc quidem modo paria peccata sunt.</h5>

<p>Istam voluptatem perpetuam quis potest praestare sapienti? Videamus igitur sententias eorum, tum ad verba redeamus. Omnes enim iucundum motum, quo sensus hilaretur. Tum Triarius: Posthac quidem, inquit, audacius. Ratio quidem vestra sic cogit. At ego quem huic anteponam non audeo dicere; </p>

<h6>Illa sunt similia: hebes acies est cuipiam oculorum, corpore alius senescit;</h6>

<p>Utilitatis causa amicitia est quaesita. Avaritiamne minuis? Quid Zeno? Ita credo. Equidem e Cn. Hoc sic expositum dissimile est superiori. </p>

<h2>Duo enim genera quae erant, fecit tria.</h2>

<p>Quippe: habes enim a rhetoribus; Quae cum dixisset paulumque institisset, Quid est? Sed quid sentiat, non videtis. Frater et T. Sin aliud quid voles, postea. Ita nemo beato beatior. </p>

<p>Ex rebus enim timiditas, non ex vocabulis nascitur. Quae duo sunt, unum facit. Sed quae tandem ista ratio est? Ita graviter et severe voluptatem secrevit a bono. Multoque hoc melius nos veriusque quam Stoici. Sit hoc ultimum bonorum, quod nunc a me defenditur; </p>' --container 'FooBarBazOutput' --position '13.5'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo80Bar94Baz' --container 'FooBarBazDynamicOutput' --position '40.15' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo82Bar46Baz' --output '<h1>Sed ille, ut dixi, vitiose.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Immo alio genere; Quamquam tu hanc copiosiorem etiam soles dicere. Multoque hoc melius nos veriusque quam Stoici. Sequitur disserendi ratio cognitioque naturae; Duo Reges: constructio interrete. Non laboro, inquit, de nomine. </p>

<p>Tollenda est atque extrahenda radicitus. Pollicetur certe. Quis istud possit, inquit, negare? Quodsi ipsam honestatem undique pertectam atque absolutam. </p>

<p>Sed mehercule pergrata mihi oratio tua. Praeclare hoc quidem. Quae cum dixisset, finem ille. Inde igitur, inquit, ordiendum est. Nihil opus est exemplis hoc facere longius. </p>

<h2>Certe non potest.</h2>

<p>Quorum altera prosunt, nocent altera. Pauca mutat vel plura sane; Eam stabilem appellas. Esse enim quam vellet iniquus iustus poterat inpune. </p>

<h3>Quid turpius quam sapientis vitam ex insipientium sermone pendere?</h3>

<p>Itaque his sapiens semper vacabit. Tria genera bonorum; De illis, cum volemus. Haec para/doca illi, nos admirabilia dicamus. De vacuitate doloris eadem sententia erit. Sed potestne rerum maior esse dissensio? </p>

<p>Sequitur disserendi ratio cognitioque naturae; An nisi populari fama? Illa tamen simplicia, vestra versuta. Bonum valitudo: miser morbus. Et nemo nimium beatus est; Istam voluptatem, inquit, Epicurus ignorat? </p>

<h4>Tria genera bonorum;</h4>

<p>Quid sequatur, quid repugnet, vident. Quorum sine causa fieri nihil putandum est. Tu vero, inquam, ducas licet, si sequetur; Beatus sibi videtur esse moriens. </p>

<p>Confecta res esset. Immo videri fortasse. Scrupulum, inquam, abeunti; Quid nunc honeste dicit? Tubulo putas dicere? At coluit ipse amicitias. Restinguet citius, si ardentem acceperit. </p>

<p>Primum in nostrane potestate est, quid meminerimus? Sed erat aequius Triarium aliquid de dissensione nostra iudicare. Si longus, levis. Quonam, inquit, modo? Id mihi magnum videtur. </p>

<h5>Hoc est non modo cor non habere, sed ne palatum quidem.</h5>

<p>Nunc vides, quid faciat. Hoc non est positum in nostra actione. Ita graviter et severe voluptatem secrevit a bono. </p>' --container 'FooBarBazOutput' --position '74.28'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo83Bar26Baz' --container 'FooBarBazDynamicOutput' --position '98.24' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo83Bar64Baz' --output '<h1>Omnes enim iucundum motum, quo sensus hilaretur.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tuo vero id quidem, inquam, arbitratu. Duo Reges: constructio interrete. </p>

<h2>Quid enim mihi potest esse optatius quam cum Catone, omnium virtutum auctore, de virtutibus disputare?</h2>

<p>Multoque hoc melius nos veriusque quam Stoici. Dici enim nihil potest verius. Nihil opus est exemplis hoc facere longius. Sine ea igitur iucunde negat posse se vivere? Sin tantum modo ad indicia veteris memoriae cognoscenda, curiosorum. Res enim concurrent contrariae. Ecce aliud simile dissimile. Tollenda est atque extrahenda radicitus. </p>

<p>Sullae consulatum? Nihil enim iam habes, quod ad corpus referas; Hoc sic expositum dissimile est superiori. Ne discipulum abducam, times. Conferam tecum, quam cuique verso rem subicias; Beatum, inquit. Reguli reiciendam; Etiam beatissimum? </p>

<p>Occultum facinus esse potuerit, gaudebit; Quorum sine causa fieri nihil putandum est. Sed nunc, quod agimus; Bestiarum vero nullum iudicium puto. </p>

<p>Tecum optime, deinde etiam cum mediocri amico. Quod ea non occurrentia fingunt, vincunt Aristonem; Restatis igitur vos; Dat enim intervalla et relaxat. </p>

<p>Iam in altera philosophiae parte. Quid enim possumus hoc agere divinius? Quae ista amicitia est? Quid est, quod ab ea absolvi et perfici debeat? Certe non potest. </p>

<p>Non laboro, inquit, de nomine. Itaque contra est, ac dicitis; Sed ille, ut dixi, vitiose. Nobis aliter videtur, recte secusne, postea; Eademne, quae restincta siti? </p>

<h3>Servari enim iustitia nisi a forti viro, nisi a sapiente non potest.</h3>

<p>Quid, quod res alia tota est? Quae sequuntur igitur? Nunc haec primum fortasse audientis servire debemus. Quid nunc honeste dicit? Quae cum dixisset, finem ille. Haec quo modo conveniant, non sane intellego. Facillimum id quidem est, inquam. Erat enim Polemonis. </p>

<p>Restinguet citius, si ardentem acceperit. Indicant pueri, in quibus ut in speculis natura cernitur. Fortasse id optimum, sed ubi illud: Plus semper voluptatis? Prioris generis est docilitas, memoria; </p>

<p>Sit enim idem caecus, debilis. Respondent extrema primis, media utrisque, omnia omnibus. Non semper, inquam; Ex rebus enim timiditas, non ex vocabulis nascitur. Nos cum te, M. Cur id non ita fit? </p>' --container 'FooBarBazOutput' --position '24.25'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo85Bar20Baz' --output '<h1>Nam, ut sint illa vendibiliora, haec uberiora certe sunt.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nos vero, inquit ille; Nihil opus est exemplis hoc facere longius. Ut id aliis narrare gestiant? Nam quid possumus facere melius? Prioris generis est docilitas, memoria; Duo Reges: constructio interrete. </p>

<p>Hoc simile tandem est? Sed plane dicit quod intellegit. Hoc ipsum elegantius poni meliusque potuit. Tum Piso: Quoniam igitur aliquid omnes, quid Lucius noster? Quod quidem iam fit etiam in Academia. Hoc Hieronymus summum bonum esse dixit. Quid enim de amicitia statueris utilitatis causa expetenda vides. </p>

<h2>Aperiendum est igitur, quid sit voluptas;</h2>

<p>Memini me adesse P. Praeclare hoc quidem. At eum nihili facit; Omnia contraria, quos etiam insanos esse vultis. </p>

<p>Moriatur, inquit. Quid est igitur, inquit, quod requiras? Idemne, quod iucunde? Sed vos squalidius, illorum vides quam niteat oratio. Nam de isto magna dissensio est. Quid nunc honeste dicit? Nihilo magis. Neque solum ea communia, verum etiam paria esse dixerunt. </p>

<p>Efficiens dici potest. Bestiarum vero nullum iudicium puto. Sint ista Graecorum; Utram tandem linguam nescio? </p>

<p>Non autem hoc: igitur ne illud quidem. Quod cum dixissent, ille contra. Erit enim mecum, si tecum erit. Cyrenaici quidem non recusant; Istam voluptatem perpetuam quis potest praestare sapienti? </p>

<p>Sed ille, ut dixi, vitiose. Laboro autem non sine causa; Quae cum essent dicta, discessimus. Hoc loco tenere se Triarius non potuit. Itaque his sapiens semper vacabit. De hominibus dici non necesse est. Ut optime, secundum naturam affectum esse possit. Ratio enim nostra consentit, pugnat oratio. </p>

<p>Dicimus aliquem hilare vivere; Non est igitur voluptas bonum. Quos quidem tibi studiose et diligenter tractandos magnopere censeo. Non laboro, inquit, de nomine. Urgent tamen et nihil remittunt. Sint modo partes vitae beatae. </p>

<p>Tria genera bonorum; Estne, quaeso, inquam, sitienti in bibendo voluptas? Non quam nostram quidem, inquit Pomponius iocans; Quae cum essent dicta, discessimus. At eum nihili facit; Deprehensus omnem poenam contemnet. </p>

<p>Egone quaeris, inquit, quid sentiam? Summum ením bonum exposuit vacuitatem doloris; </p>' --container 'FooBarBazOutput' --position '36.63'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo85Bar38Baz' --output '<h1>Quae autem natura suae primae institutionis oblita est?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quid sequatur, quid repugnet, vident. Respondent extrema primis, media utrisque, omnia omnibus. Certe, nisi voluptatem tanti aestimaretis. Sed eum qui audiebant, quoad poterant, defendebant sententiam suam. Itaque his sapiens semper vacabit. Duo Reges: constructio interrete. </p>

<p>In schola desinis. Paria sunt igitur. </p>

<h3>Beatus sibi videtur esse moriens.</h3>

<p>Nunc agendum est subtilius. Aperiendum est igitur, quid sit voluptas; Quid enim est a Chrysippo praetermissum in Stoicis? Respondent extrema primis, media utrisque, omnia omnibus. </p>

<p>Nunc agendum est subtilius. Equidem etiam Epicurum, in physicis quidem, Democriteum puto. Sed fac ista esse non inportuna; Quid igitur, inquit, eos responsuros putas? Negat esse eam, inquit, propter se expetendam. </p>

<p>Erit enim mecum, si tecum erit. Si quae forte-possumus. Aliud igitur esse censet gaudere, aliud non dolere. Magna laus. </p>

<p>Stoici scilicet. Urgent tamen et nihil remittunt. Cur iustitia laudatur? Honesta oratio, Socratica, Platonis etiam. </p>

<h4>Quid est igitur, inquit, quod requiras?</h4>

<p>At multis se probavit. Sed videbimus. At ille pellit, qui permulcet sensum voluptate. Ne in odium veniam, si amicum destitero tueri. Negare non possum. Gerendus est mos, modo recte sentiat. </p>

<h2>Quonam, inquit, modo?</h2>

<p>De ingenio eius in his disputationibus, non de moribus quaeritur. Cave putes quicquam esse verius. Quis istum dolorem timet? Itaque his sapiens semper vacabit. Id Sextilius factum negabat. Poterat autem inpune; An est aliquid, quod te sua sponte delectet? </p>

<p>Quis istud, quaeso, nesciebat? Sed fortuna fortis; Poterat autem inpune; Ille incendat? Quis istum dolorem timet? Aliter enim nosmet ipsos nosse non possumus. </p>

<p>Quod vestri non item. Itaque ab his ordiamur. </p>' --container 'FooBarBazOutput' --position '38.92'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo85Bar60Baz' --output '<h1>Quae est igitur causa istarum angustiarum?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tubulo putas dicere? Stoicos roga. Quae diligentissime contra Aristonem dicuntur a Chryippo. Hoc loco tenere se Triarius non potuit. Duo Reges: constructio interrete. </p>

<p>Sed vos squalidius, illorum vides quam niteat oratio. Itaque ad tempus ad Pisonem omnes. Pauca mutat vel plura sane; Quid sequatur, quid repugnet, vident. Dici enim nihil potest verius. Pugnant Stoici cum Peripateticis. Si longus, levis. Utram tandem linguam nescio? </p>

<p>Neutrum vero, inquit ille. Nemo igitur esse beatus potest. Istic sum, inquit. At iam decimum annum in spelunca iacet. Poterat autem inpune; Quid turpius quam sapientis vitam ex insipientium sermone pendere? </p>

<p>Ratio enim nostra consentit, pugnat oratio. Quid iudicant sensus? Stoici scilicet. Beatum, inquit. Nullus est igitur cuiusquam dies natalis. Nihil opus est exemplis hoc facere longius. </p>

<h3>Erat enim res aperta.</h3>

<p>Quid de Pythagora? Eaedem res maneant alio modo. Quis est tam dissimile homini. Cur iustitia laudatur? Nos vero, inquit ille; </p>

<p>Si quae forte-possumus. Si longus, levis. Sed nunc, quod agimus; Sed plane dicit quod intellegit. Age, inquies, ista parva sunt. Si longus, levis. </p>

<p>Prioris generis est docilitas, memoria; Quod ea non occurrentia fingunt, vincunt Aristonem; </p>

<h2>Si autem id non concedatur, non continuo vita beata tollitur.</h2>

<p>Age, inquies, ista parva sunt. Hunc vos beatum; </p>

<p>Videamus animi partes, quarum est conspectus illustrior; Pollicetur certe. Quod cum dixissent, ille contra. </p>

<p>An potest cupiditas finiri? Haec igitur Epicuri non probo, inquam. Proclivi currit oratio. </p>' --container 'FooBarBazOutput' --position '34.71'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo86Bar48Baz' --output '<h1>Ne in odium veniam, si amicum destitero tueri.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Qui convenit? Hoc tu nunc in illo probas. Iam id ipsum absurdum, maximum malum neglegi. Qualem igitur hominem natura inchoavit? Duo Reges: constructio interrete. Confecta res esset. </p>

<p>At multis se probavit. Quid igitur, inquit, eos responsuros putas? Ergo hoc quidem apparet, nos ad agendum esse natos. Nihil opus est exemplis hoc facere longius. Haec quo modo conveniant, non sane intellego. Utilitatis causa amicitia est quaesita. Non est igitur voluptas bonum. Quae contraria sunt his, malane? </p>

<p>Itaque contra est, ac dicitis; Zenonis est, inquam, hoc Stoici. Multoque hoc melius nos veriusque quam Stoici. Dat enim intervalla et relaxat. </p>

<p>Haec dicuntur fortasse ieiunius; Nescio quo modo praetervolavit oratio. Negat esse eam, inquit, propter se expetendam. </p>

<h2>Ergo, inquit, tibi Q.</h2>

<p>Graccho, eius fere, aequalí? Honesta oratio, Socratica, Platonis etiam. Tum Piso: Quoniam igitur aliquid omnes, quid Lucius noster? Comprehensum, quod cognitum non habet? Nemo igitur esse beatus potest. Est, ut dicis, inquam. Re mihi non aeque satisfacit, et quidem locis pluribus. </p>

<p>Ad eas enim res ab Epicuro praecepta dantur. Itaque his sapiens semper vacabit. Quae quidem sapientes sequuntur duce natura tamquam videntes; Quare conare, quaeso. Sed nunc, quod agimus; Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; </p>

<p>Quis istud possit, inquit, negare? Bonum integritas corporis: misera debilitas. Quare attende, quaeso. Non semper, inquam; Itaque contra est, ac dicitis; Respondeat totidem verbis. </p>

<p>Hic nihil fuit, quod quaereremus. Eiuro, inquit adridens, iniquum, hac quidem de re; Illi enim inter se dissentiunt. </p>

<p>Hic ambiguo ludimur. Tanta vis admonitionis inest in locis; Ne in odium veniam, si amicum destitero tueri. Sed ad illum redeo. Quae cum dixisset, finem ille. Primum Theophrasti, Strato, physicum se voluit; </p>

<p>Quid autem habent admirationis, cum prope accesseris? Nihil opus est exemplis hoc facere longius. Falli igitur possumus. Quare attende, quaeso. Aeque enim contingit omnibus fidibus, ut incontentae sint. At ille pellit, qui permulcet sensum voluptate. Ratio quidem vestra sic cogit. </p>' --container 'FooBarBazOutput' --position '8.12'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo86Bar80Baz' --container 'FooBarBazDynamicOutput' --position '13.61' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo87Bar26Baz' --output '<h1>Aliena dixit in physicis nec ea ipsa, quae tibi probarentur;</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praeclarae mortes sunt imperatoriae; Sed tamen intellego quid velit. Age, inquies, ista parva sunt. Duo Reges: constructio interrete. Perge porro; Quo plebiscito decreta a senatu est consuli quaestio Cn. Graccho, eius fere, aequalí? </p>

<p>Bonum incolumis acies: misera caecitas. Age, inquies, ista parva sunt. Aperiendum est igitur, quid sit voluptas; Et nemo nimium beatus est; </p>

<h5>Inde igitur, inquit, ordiendum est.</h5>

<p>Quis enim redargueret? Honesta oratio, Socratica, Platonis etiam. Nulla erit controversia. Itaque contra est, ac dicitis; Venit ad extremum; </p>

<p>Iam contemni non poteris. Eam stabilem appellas. Prioris generis est docilitas, memoria; Sed ad bona praeterita redeamus. </p>

<p>Recte, inquit, intellegis. A mene tu? Primum divisit ineleganter; Sit enim idem caecus, debilis. Non potes, nisi retexueris illa. Est, ut dicis, inquam. </p>

<h2>Satis est ad hoc responsum.</h2>

<p>Praeteritis, inquit, gaudeo. Omnia contraria, quos etiam insanos esse vultis. Collatio igitur ista te nihil iuvat. </p>

<p>Quae quidem vel cum periculo est quaerenda vobis; Quid ad utilitatem tantae pecuniae? Atqui reperies, inquit, in hoc quidem pertinacem; Restinguet citius, si ardentem acceperit. Praeclarae mortes sunt imperatoriae; </p>

<h3>Isto modo ne improbos quidem, si essent boni viri.</h3>

<p>Immo alio genere; Idemne, quod iucunde? Nunc haec primum fortasse audientis servire debemus. Praeclare hoc quidem. Nonne igitur tibi videntur, inquit, mala? Videamus animi partes, quarum est conspectus illustrior; </p>

<p>Efficiens dici potest. Sed residamus, inquit, si placet. </p>

<h4>Ex quo illud efficitur, qui bene cenent omnis libenter cenare, qui libenter, non continuo bene.</h4>

<p>Fortemne possumus dicere eundem illum Torquatum? Itaque hic ipse iam pridem est reiectus; Prioris generis est docilitas, memoria; Negat enim summo bono afferre incrementum diem. </p>' --container 'FooBarBazOutput' --position '2.42'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo87Bar84Baz' --container 'FooBarBazDynamicOutput' --position '16.3' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo87Bar89Baz' --output '<h1>Quid ergo attinet gloriose loqui, nisi constanter loquare?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ratio enim nostra consentit, pugnat oratio. Sed in rebus apertissimis nimium longi sumus. Cum audissem Antiochum, Brute, ut solebam, cum M. Nihilo beatiorem esse Metellum quam Regulum. </p>

<p>Quid ad utilitatem tantae pecuniae? An eiusdem modi? </p>

<p>Conferam avum tuum Drusum cum C. Dicimus aliquem hilare vivere; Murenam te accusante defenderem. Tollenda est atque extrahenda radicitus. Fortemne possumus dicere eundem illum Torquatum? Sint modo partes vitae beatae. </p>

<p>Cur post Tarentum ad Archytam? Duo Reges: constructio interrete. </p>

<p>Quod totum contra est. Is es profecto tu. Si enim ad populum me vocas, eum. Illa tamen simplicia, vestra versuta. </p>

<p>Tum mihi Piso: Quid ergo? Post enim Chrysippum eum non sane est disputatum. Id enim natura desiderat. Sed fortuna fortis; Ea possunt paria non esse. </p>

<h4>Tubulum fuisse, qua illum, cuius is condemnatus est rogatione, P.</h4>

<p>Magna laus. Haec para/doca illi, nos admirabilia dicamus. Efficiens dici potest. Quae cum dixisset paulumque institisset, Quid est? Quonam modo? </p>

<h2>Cupit enim dícere nihil posse ad beatam vitam deesse sapienti.</h2>

<p>Et quod est munus, quod opus sapientiae? Minime vero, inquit ille, consentit. Hic ambiguo ludimur. </p>

<h3>Et quod est munus, quod opus sapientiae?</h3>

<p>Mihi enim satis est, ipsis non satis. Ego vero isti, inquam, permitto. Nec vero alia sunt quaerenda contra Carneadeam illam sententiam. Haec dicuntur inconstantissime. </p>

<p>Nunc omni virtuti vitium contrario nomine opponitur. Quid sequatur, quid repugnet, vident. Frater et T. Ille enim occurrentia nescio quae comminiscebatur; Dicimus aliquem hilare vivere; Prodest, inquit, mihi eo esse animo. </p>' --container 'FooBarBazOutput' --position '30.16'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo88Bar33Baz' --container 'FooBarBazDynamicOutput' --position '95.95' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo88Bar84Baz' --container 'FooBarBazDynamicOutput' --position '6.7' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo90Bar88Baz' --output '<h1>Cupit enim dícere nihil posse ad beatam vitam deesse sapienti.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et quod est munus, quod opus sapientiae? Prioris generis est docilitas, memoria; Diodorus, eius auditor, adiungit ad honestatem vacuitatem doloris. Quae est igitur causa istarum angustiarum? Quo modo? Quae cum dixisset, finem ille. </p>

<p>Tum mihi Piso: Quid ergo? Scrupulum, inquam, abeunti; Nihil ad rem! Ne sit sane; Quod ea non occurrentia fingunt, vincunt Aristonem; Comprehensum, quod cognitum non habet? </p>

<h4>Ergo in utroque exercebantur, eaque disciplina effecit tantam illorum utroque in genere dicendi copiam.</h4>

<p>Collatio igitur ista te nihil iuvat. Sint ista Graecorum; Quis istud possit, inquit, negare? Nobis aliter videtur, recte secusne, postea; Esse enim, nisi eris, non potes. Post enim Chrysippum eum non sane est disputatum. Qua tu etiam inprudens utebare non numquam. Quid nunc honeste dicit? </p>

<h5>Quamvis enim depravatae non sint, pravae tamen esse possunt.</h5>

<p>Ut optime, secundum naturam affectum esse possit. Recte dicis; </p>

<p>Duo Reges: constructio interrete. Eademne, quae restincta siti? Equidem, sed audistine modo de Carneade? Atqui reperies, inquit, in hoc quidem pertinacem; Prioris generis est docilitas, memoria; </p>

<h3>Sic, et quidem diligentius saepiusque ista loquemur inter nos agemusque communiter.</h3>

<p>Utilitatis causa amicitia est quaesita. Quamquam te quidem video minime esse deterritum. Nunc agendum est subtilius. Quae similitudo in genere etiam humano apparet. </p>

<p>Ille enim occurrentia nescio quae comminiscebatur; Ut optime, secundum naturam affectum esse possit. </p>

<p>Certe, nisi voluptatem tanti aestimaretis. Hanc ergo intuens debet institutum illud quasi signum absolvere. Nunc vides, quid faciat. Sed videbimus. Egone quaeris, inquit, quid sentiam? Quod quidem iam fit etiam in Academia. </p>

<h2>Hoc mihi cum tuo fratre convenit.</h2>

<p>Hanc ergo intuens debet institutum illud quasi signum absolvere. Equidem e Cn. Ita prorsus, inquam; Inde igitur, inquit, ordiendum est. </p>

<p>De vacuitate doloris eadem sententia erit. Aliter enim explicari, quod quaeritur, non potest. </p>' --container 'FooBarBazOutput' --position '30.99'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo90Bar97Baz' --output '<h1>Quo modo?</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Illa tamen simplicia, vestra versuta. At hoc in eo M. Duo Reges: constructio interrete. Iam in altera philosophiae parte. </p>

<p>Sint ista Graecorum; Proclivi currit oratio. De hominibus dici non necesse est. Hoc ipsum elegantius poni meliusque potuit. Istic sum, inquit. Quid, de quo nulla dissensio est? Primum Theophrasti, Strato, physicum se voluit; Negare non possum. </p>

<p>Ut optime, secundum naturam affectum esse possit. Quid nunc honeste dicit? </p>

<p>Sed fac ista esse non inportuna; Omnia contraria, quos etiam insanos esse vultis. Sint modo partes vitae beatae. Erat enim res aperta. Hoc Hieronymus summum bonum esse dixit. Quae cum essent dicta, discessimus. Tollenda est atque extrahenda radicitus. Quacumque enim ingredimur, in aliqua historia vestigium ponimus. </p>

<p>Satis est ad hoc responsum. Quis istud possit, inquit, negare? Nescio quo modo praetervolavit oratio. Quae ista amicitia est? Ad eas enim res ab Epicuro praecepta dantur. Negat esse eam, inquit, propter se expetendam. </p>

<p>Quid ait Aristoteles reliquique Platonis alumni? Bonum incolumis acies: misera caecitas. Non laboro, inquit, de nomine. Quae duo sunt, unum facit. Quonam, inquit, modo? </p>

<p>Quae contraria sunt his, malane? Id mihi magnum videtur. Duarum enim vitarum nobis erunt instituta capienda. Si longus, levis; </p>

<h2>Qui autem esse poteris, nisi te amor ipse ceperit?</h2>

<p>Sed in rebus apertissimis nimium longi sumus. At iam decimum annum in spelunca iacet. Id est enim, de quo quaerimus. Philosophi autem in suis lectulis plerumque moriuntur. </p>

<p>Omnia contraria, quos etiam insanos esse vultis. Sed potestne rerum maior esse dissensio? Collige omnia, quae soletis: Praesidium amicorum. Compensabatur, inquit, cum summis doloribus laetitia. Ratio quidem vestra sic cogit. Quae diligentissime contra Aristonem dicuntur a Chryippo. </p>

<h3>Illa argumenta propria videamus, cur omnia sint paria peccata.</h3>

<p>Venit ad extremum; Sin aliud quid voles, postea. Summum ením bonum exposuit vacuitatem doloris; Quis Aristidem non mortuum diligit? Immo alio genere; </p>' --container 'FooBarBazOutput' --position '13.38'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo92Bar76Baz' --output '<h1>Duarum enim vitarum nobis erunt instituta capienda.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quorum altera prosunt, nocent altera. Tria genera bonorum; </p>

<h2>Uterque enim summo bono fruitur, id est voluptate.</h2>

<p>Illi enim inter se dissentiunt. Polycratem Samium felicem appellabant. Equidem e Cn. Eam stabilem appellas. </p>

<p>Duo Reges: constructio interrete. Immo alio genere; Nondum autem explanatum satis, erat, quid maxime natura vellet. Quae cum dixisset, finem ille. Nunc haec primum fortasse audientis servire debemus. </p>

<h3>Quasi ego id curem, quid ille aiat aut neget.</h3>

<p>Illa tamen simplicia, vestra versuta. Idemne, quod iucunde? Nihil illinc huc pervenit. Huius ego nunc auctoritatem sequens idem faciam. Tu vero, inquam, ducas licet, si sequetur; Non est ista, inquam, Piso, magna dissensio. </p>

<p>Si longus, levis; Eam tum adesse, cum dolor omnis absit; Iam contemni non poteris. Haec dicuntur inconstantissime. Nam quid possumus facere melius? </p>

<p>Sed hoc sane concedamus. Hunc vos beatum; Equidem e Cn. Sed fac ista esse non inportuna; Conferam tecum, quam cuique verso rem subicias; Illi enim inter se dissentiunt. Itaque hic ipse iam pridem est reiectus; </p>

<p>Tecum optime, deinde etiam cum mediocri amico. Itaque his sapiens semper vacabit. Estne, quaeso, inquam, sitienti in bibendo voluptas? Ut pulsi recurrant? </p>

<p>Quamquam te quidem video minime esse deterritum. Nam quid possumus facere melius? </p>

<p>Num quid tale Democritus? Ita prorsus, inquam; Ac tamen hic mallet non dolere. Videsne, ut haec concinant? Quod cum dixissent, ille contra. </p>

<h4>Verba tu fingas et ea dicas, quae non sentias?</h4>

<p>Sed quot homines, tot sententiae; Duarum enim vitarum nobis erunt instituta capienda. Sedulo, inquam, faciam. Illa tamen simplicia, vestra versuta. Egone quaeris, inquit, quid sentiam? </p>' --container 'FooBarBazOutput' --position '66.32'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo93Bar74Baz' --container 'FooBarBazDynamicOutput' --position '8.21' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo94Bar36Baz' --output '<h1>Sed haec quidem liberius ab eo dicuntur et saepius.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est enim effectrix multarum et magnarum voluptatum. Id Sextilius factum negabat. Quid Zeno? Duo Reges: constructio interrete. </p>

<p>Nemo igitur esse beatus potest. Re mihi non aeque satisfacit, et quidem locis pluribus. Tum Triarius: Posthac quidem, inquit, audacius. Tum Torquatus: Prorsus, inquit, assentior; </p>

<p>Immo alio genere; Res enim concurrent contrariae. Tum mihi Piso: Quid ergo? Duarum enim vitarum nobis erunt instituta capienda. Cur haec eadem Democritus? Scrupulum, inquam, abeunti; </p>

<p>Rationis enim perfectio est virtus; Easdemne res? Haec igitur Epicuri non probo, inquam. Sed quae tandem ista ratio est? </p>

<h4>Sin laboramus, quis est, qui alienae modum statuat industriae?</h4>

<p>Sint modo partes vitae beatae. Respondeat totidem verbis. Recte dicis; </p>

<p>Praeteritis, inquit, gaudeo. Non potes, nisi retexueris illa. Teneo, inquit, finem illi videri nihil dolere. Primum in nostrane potestate est, quid meminerimus? Quod iam a me expectare noli. </p>

<p>Duo enim genera quae erant, fecit tria. Indicant pueri, in quibus ut in speculis natura cernitur. Respondent extrema primis, media utrisque, omnia omnibus. Sed vos squalidius, illorum vides quam niteat oratio. Omnia contraria, quos etiam insanos esse vultis. Quid ergo attinet gloriose loqui, nisi constanter loquare? Memini vero, inquam; </p>

<h2>Non enim iam stirpis bonum quaeret, sed animalis.</h2>

<p>Quod quidem iam fit etiam in Academia. Ne discipulum abducam, times. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; Hunc vos beatum; </p>

<p>At enim hic etiam dolore. Sic enim censent, oportunitatis esse beate vivere. Quod iam a me expectare noli. Sed tamen intellego quid velit. Restinguet citius, si ardentem acceperit. Quid ergo hoc loco intellegit honestum? </p>

<h3>Quod non faceret, si in voluptate summum bonum poneret.</h3>

<p>Facillimum id quidem est, inquam. Ratio quidem vestra sic cogit. Audeo dicere, inquit. Tollenda est atque extrahenda radicitus. At certe gravius. </p>' --container 'FooBarBazOutput' --position '79.2'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo96Bar25Baz' --container 'FooBarBazDynamicOutput' --position '79.78' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo96Bar50Baz' --container 'FooBarBazDynamicOutput' --position '93.65' 

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo96Bar59Baz' --output '<h1>Est enim effectrix multarum et magnarum voluptatum.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Si longus, levis. Utilitatis causa amicitia est quaesita. Duo Reges: constructio interrete. Tubulo putas dicere? Memini me adesse P. Dici enim nihil potest verius. Bestiarum vero nullum iudicium puto. </p>

<p>Ratio quidem vestra sic cogit. Proclivi currit oratio. Bonum valitudo: miser morbus. Tenent mordicus. Quamquam tu hanc copiosiorem etiam soles dicere. Ego vero isti, inquam, permitto. Cur post Tarentum ad Archytam? </p>

<p>Bonum patria: miserum exilium. Erat enim Polemonis. Quonam, inquit, modo? Negat enim summo bono afferre incrementum diem. Vitae autem degendae ratio maxime quidem illis placuit quieta. Quid enim de amicitia statueris utilitatis causa expetenda vides. </p>

<p>Philosophi autem in suis lectulis plerumque moriuntur. Num quid tale Democritus? Gerendus est mos, modo recte sentiat. Summae mihi videtur inscitiae. Quo modo autem philosophus loquitur? Estne, quaeso, inquam, sitienti in bibendo voluptas? </p>

<h2>Nec tamen ullo modo summum pecudis bonum et hominis idem mihi videri potest.</h2>

<p>Non igitur bene. Quae contraria sunt his, malane? Quippe: habes enim a rhetoribus; </p>

<p>Quod equidem non reprehendo; Summus dolor plures dies manere non potest? Sed residamus, inquit, si placet. Sullae consulatum? Age sane, inquam. Ut optime, secundum naturam affectum esse possit. Quis hoc dicit? Honesta oratio, Socratica, Platonis etiam. </p>

<p>Nunc haec primum fortasse audientis servire debemus. Non est igitur voluptas bonum. Sed mehercule pergrata mihi oratio tua. At multis se probavit. Negat esse eam, inquit, propter se expetendam. Ea possunt paria non esse. </p>

<p>Poterat autem inpune; Certe non potest. Zenonis est, inquam, hoc Stoici. Si quicquam extra virtutem habeatur in bonis. </p>

<p>Quod quidem iam fit etiam in Academia. Dicimus aliquem hilare vivere; Suo genere perveniant ad extremum; Itaque hic ipse iam pridem est reiectus; Scio enim esse quosdam, qui quavis lingua philosophari possint; Quid autem habent admirationis, cum prope accesseris? </p>

<p>Erat enim res aperta. Sed ego in hoc resisto; An tu me de L. Quid de Platone aut de Democrito loquar? Quid, si etiam iucunda memoria est praeteritorum malorum? Quod ea non occurrentia fingunt, vincunt Aristonem; Egone quaeris, inquit, quid sentiam? Quae autem natura suae primae institutionis oblita est? </p>' --container 'FooBarBazOutput' --position '8.27'

rig --new-output-component --for-app 'FooBarBaz' --name 'Foo97Bar24Baz' --output '<h1>Non laboro, inquit, de nomine.</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Memini vero, inquam; Quae in controversiam veniunt, de iis, si placet, disseramus. Sequitur disserendi ratio cognitioque naturae; Quid sequatur, quid repugnet, vident. Hoc mihi cum tuo fratre convenit. Duo Reges: constructio interrete. </p>

<p>Ego vero isti, inquam, permitto. Quis non odit sordidos, vanos, leves, futtiles? Prioris generis est docilitas, memoria; </p>

<p>Idemne, quod iucunde? Quae sequuntur igitur? Atqui reperies, inquit, in hoc quidem pertinacem; In schola desinis. </p>

<h2>Sit hoc ultimum bonorum, quod nunc a me defenditur;</h2>

<p>Et quod est munus, quod opus sapientiae? Expectoque quid ad id, quod quaerebam, respondeas. </p>

<p>Tamen a proposito, inquam, aberramus. Illa tamen simplicia, vestra versuta. Quod cum dixissent, ille contra. Si quicquam extra virtutem habeatur in bonis. Nondum autem explanatum satis, erat, quid maxime natura vellet. An potest cupiditas finiri? </p>

<h3>Utilitatis causa amicitia est quaesita.</h3>

<p>Sine ea igitur iucunde negat posse se vivere? Praeclarae mortes sunt imperatoriae; Cur iustitia laudatur? Tibi hoc incredibile, quod beatissimum. </p>

<h4>Compensabatur, inquit, cum summis doloribus laetitia.</h4>

<p>Non est igitur summum malum dolor. Reguli reiciendam; Audeo dicere, inquit. Certe, nisi voluptatem tanti aestimaretis. Quam nemo umquam voluptatem appellavit, appellat; At iam decimum annum in spelunca iacet. </p>

<p>Quod autem ratione actum est, id officium appellamus. Omnes enim iucundum motum, quo sensus hilaretur. Eam stabilem appellas. Uterque enim summo bono fruitur, id est voluptate. Negat enim summo bono afferre incrementum diem. Quid me istud rogas? </p>

<p>Rationis enim perfectio est virtus; Erit enim mecum, si tecum erit. Si quidem, inquit, tollerem, sed relinquo. Eadem nunc mea adversum te oratio est. Sed quod proximum fuit non vidit. Quamquam id quidem, infinitum est in hac urbe; </p>

<p>Ea possunt paria non esse. Facile est hoc cernere in primis puerorum aetatulis. Ecce aliud simile dissimile. At iste non dolendi status non vocatur voluptas. An nisi populari fama? </p>' --container 'FooBarBazOutput' --position '73.75'

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo97Bar61Baz' --container 'FooBarBazDynamicOutput' --position '69.51' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo97Bar85Baz' --container 'FooBarBazDynamicOutput' --position '82.15' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo98Bar18Baz' --container 'FooBarBazDynamicOutput' --position '78.93' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo99Bar35Baz' --container 'FooBarBazDynamicOutput' --position '29.93' 

rig --new-dynamic-output-component --for-app 'FooBarBaz' --name 'Foo99Bar76Baz' --container 'FooBarBazDynamicOutput' --position '95.15' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --requests 'Foo100Bar18Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --requests 'Foo100Bar18Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --requests 'Foo100Bar18Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --requests 'Foo100Bar18Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --dynamic-output-components 'DDD' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --output-components 'CCC'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --output-components 'BBB'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --output-components 'AAA'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar18Baz' --dynamic-output-components 'Foo100Bar18Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar64Baz' --requests 'Foo100Bar64Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar64Baz' --requests 'Foo100Bar64Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar64Baz' --requests 'Foo100Bar64Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar64Baz' --requests 'Foo100Bar64Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar64Baz' --output-components 'Foo100Bar64Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar99Baz' --requests 'Foo100Bar99Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar99Baz' --requests 'Foo100Bar99Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar99Baz' --requests 'Foo100Bar99Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar99Baz' --requests 'Foo100Bar99Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo100Bar99Baz' --output-components 'Foo100Bar99Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo10Bar10Baz' --dynamic-output-components 'Foo10Bar10Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo12Bar41Baz' --requests 'Foo12Bar41Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo12Bar41Baz' --requests 'Foo12Bar41Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo12Bar41Baz' --requests 'Foo12Bar41Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo12Bar41Baz' --requests 'Foo12Bar41Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo12Bar41Baz' --dynamic-output-components 'Foo12Bar41Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo14Bar47Baz' --output-components 'Foo14Bar47Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar47Baz' --requests 'Foo15Bar47Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar47Baz' --requests 'Foo15Bar47Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar47Baz' --requests 'Foo15Bar47Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar47Baz' --requests 'Foo15Bar47Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar47Baz' --output-components 'Foo15Bar47Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar85Baz' --output-components 'Foo15Bar85Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar97Baz' --requests 'Foo15Bar97Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar97Baz' --requests 'Foo15Bar97Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar97Baz' --requests 'Foo15Bar97Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar97Baz' --requests 'Foo15Bar97Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo15Bar97Baz' --dynamic-output-components 'Foo15Bar97Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo16Bar53Baz' --requests 'Foo16Bar53Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo16Bar53Baz' --requests 'Foo16Bar53Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo16Bar53Baz' --requests 'Foo16Bar53Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo16Bar53Baz' --requests 'Foo16Bar53Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo16Bar53Baz' --output-components 'Foo16Bar53Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo17Bar90Baz' --dynamic-output-components 'Foo17Bar90Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo18Bar17Baz' --requests 'Foo18Bar17Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo18Bar17Baz' --requests 'Foo18Bar17Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo18Bar17Baz' --requests 'Foo18Bar17Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo18Bar17Baz' --requests 'Foo18Bar17Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo18Bar17Baz' --dynamic-output-components 'Foo18Bar17Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo20Bar36Baz' --requests 'Foo20Bar36Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo20Bar36Baz' --requests 'Foo20Bar36Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo20Bar36Baz' --requests 'Foo20Bar36Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo20Bar36Baz' --requests 'Foo20Bar36Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo20Bar36Baz' --output-components 'Foo20Bar36Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo22Bar28Baz' --output-components 'Foo22Bar28Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo23Bar64Baz' --output-components 'Foo23Bar64Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo24Bar48Baz' --dynamic-output-components 'Foo24Bar48Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo24Bar62Baz' --dynamic-output-components 'Foo24Bar62Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo24Bar64Baz' --dynamic-output-components 'Foo24Bar64Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar36Baz' --dynamic-output-components 'Foo25Bar36Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar58Baz' --requests 'Foo25Bar58Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar58Baz' --requests 'Foo25Bar58Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar58Baz' --requests 'Foo25Bar58Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar58Baz' --requests 'Foo25Bar58Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar58Baz' --dynamic-output-components 'Foo25Bar58Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar69Baz' --dynamic-output-components 'Foo25Bar69Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo25Bar90Baz' --dynamic-output-components 'Foo25Bar90Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo26Bar26Baz' --dynamic-output-components 'Foo26Bar26Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo29Bar78Baz' --requests 'Foo29Bar78Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo29Bar78Baz' --requests 'Foo29Bar78Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo29Bar78Baz' --requests 'Foo29Bar78Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo29Bar78Baz' --requests 'Foo29Bar78Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo29Bar78Baz' --dynamic-output-components 'Foo29Bar78Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo31Bar15Baz' --dynamic-output-components 'Foo31Bar15Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo33Bar88Baz' --dynamic-output-components 'Foo33Bar88Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo34Bar78Baz' --output-components 'Foo34Bar78Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo35Bar63Baz' --dynamic-output-components 'Foo35Bar63Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo35Bar75Baz' --requests 'Foo35Bar75Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo35Bar75Baz' --requests 'Foo35Bar75Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo35Bar75Baz' --requests 'Foo35Bar75Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo35Bar75Baz' --requests 'Foo35Bar75Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo35Bar75Baz' --output-components 'Foo35Bar75Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo36Bar17Baz' --output-components 'Foo36Bar17Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo36Bar61Baz' --requests 'Foo36Bar61Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo36Bar61Baz' --requests 'Foo36Bar61Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo36Bar61Baz' --requests 'Foo36Bar61Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo36Bar61Baz' --requests 'Foo36Bar61Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo36Bar61Baz' --output-components 'Foo36Bar61Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar47Baz' --requests 'Foo37Bar47Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar47Baz' --requests 'Foo37Bar47Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar47Baz' --requests 'Foo37Bar47Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar47Baz' --requests 'Foo37Bar47Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar47Baz' --dynamic-output-components 'Foo37Bar47Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar49Baz' --output-components 'Foo37Bar49Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar56Baz' --requests 'Foo37Bar56Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar56Baz' --requests 'Foo37Bar56Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar56Baz' --requests 'Foo37Bar56Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar56Baz' --requests 'Foo37Bar56Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar56Baz' --output-components 'Foo37Bar56Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo37Bar81Baz' --dynamic-output-components 'Foo37Bar81Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo40Bar27Baz' --dynamic-output-components 'Foo40Bar27Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar20Baz' --requests 'Foo41Bar20Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar20Baz' --requests 'Foo41Bar20Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar20Baz' --requests 'Foo41Bar20Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar20Baz' --requests 'Foo41Bar20Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar20Baz' --output-components 'Foo41Bar20Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar77Baz' --requests 'Foo41Bar77Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar77Baz' --requests 'Foo41Bar77Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar77Baz' --requests 'Foo41Bar77Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar77Baz' --requests 'Foo41Bar77Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo41Bar77Baz' --dynamic-output-components 'Foo41Bar77Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo47Bar32Baz' --dynamic-output-components 'Foo47Bar32Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo48Bar27Baz' --dynamic-output-components 'Foo48Bar27Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo48Bar43Baz' --dynamic-output-components 'Foo48Bar43Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo48Bar59Baz' --requests 'Foo48Bar59Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo48Bar59Baz' --requests 'Foo48Bar59Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo48Bar59Baz' --requests 'Foo48Bar59Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo48Bar59Baz' --requests 'Foo48Bar59Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo48Bar59Baz' --output-components 'Foo48Bar59Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo49Bar71Baz' --output-components 'Foo49Bar71Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo50Bar20Baz' --dynamic-output-components 'Foo50Bar20Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo51Bar64Baz' --dynamic-output-components 'Foo51Bar64Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo52Bar27Baz' --output-components 'Foo52Bar27Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo52Bar66Baz' --requests 'Foo52Bar66Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo52Bar66Baz' --requests 'Foo52Bar66Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo52Bar66Baz' --requests 'Foo52Bar66Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo52Bar66Baz' --requests 'Foo52Bar66Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo52Bar66Baz' --dynamic-output-components 'Foo52Bar66Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo54Bar63Baz' --output-components 'Foo54Bar63Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo54Bar74Baz' --dynamic-output-components 'Foo54Bar74Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo56Bar92Baz' --output-components 'Foo56Bar92Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo57Bar54Baz' --requests 'Foo57Bar54Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo57Bar54Baz' --requests 'Foo57Bar54Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo57Bar54Baz' --requests 'Foo57Bar54Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo57Bar54Baz' --requests 'Foo57Bar54Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo57Bar54Baz' --dynamic-output-components 'Foo57Bar54Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo61Bar11Baz' --requests 'Foo61Bar11Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo61Bar11Baz' --requests 'Foo61Bar11Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo61Bar11Baz' --requests 'Foo61Bar11Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo61Bar11Baz' --requests 'Foo61Bar11Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo61Bar11Baz' --output-components 'Foo61Bar11Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo61Bar66Baz' --dynamic-output-components 'Foo61Bar66Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo61Bar96Baz' --output-components 'Foo61Bar96Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo62Bar82Baz' --requests 'Foo62Bar82Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo62Bar82Baz' --requests 'Foo62Bar82Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo62Bar82Baz' --requests 'Foo62Bar82Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo62Bar82Baz' --requests 'Foo62Bar82Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo62Bar82Baz' --output-components 'Foo62Bar82Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo63Bar72Baz' --requests 'Foo63Bar72Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo63Bar72Baz' --requests 'Foo63Bar72Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo63Bar72Baz' --requests 'Foo63Bar72Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo63Bar72Baz' --requests 'Foo63Bar72Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo63Bar72Baz' --output-components 'Foo63Bar72Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo65Bar39Baz' --requests 'Foo65Bar39Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo65Bar39Baz' --requests 'Foo65Bar39Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo65Bar39Baz' --requests 'Foo65Bar39Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo65Bar39Baz' --requests 'Foo65Bar39Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo65Bar39Baz' --dynamic-output-components 'Foo65Bar39Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar33Baz' --requests 'Foo66Bar33Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar33Baz' --requests 'Foo66Bar33Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar33Baz' --requests 'Foo66Bar33Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar33Baz' --requests 'Foo66Bar33Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar33Baz' --dynamic-output-components 'Foo66Bar33Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar45Baz' --requests 'Foo66Bar45Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar45Baz' --requests 'Foo66Bar45Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar45Baz' --requests 'Foo66Bar45Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar45Baz' --requests 'Foo66Bar45Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo66Bar45Baz' --output-components 'Foo66Bar45Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo70Bar84Baz' --output-components 'Foo70Bar84Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar40Baz' --requests 'Foo72Bar40Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar40Baz' --requests 'Foo72Bar40Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar40Baz' --requests 'Foo72Bar40Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar40Baz' --requests 'Foo72Bar40Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar40Baz' --dynamic-output-components 'Foo72Bar40Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar64Baz' --requests 'Foo72Bar64Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar64Baz' --requests 'Foo72Bar64Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar64Baz' --requests 'Foo72Bar64Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar64Baz' --requests 'Foo72Bar64Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo72Bar64Baz' --output-components 'Foo72Bar64Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo73Bar39Baz' --requests 'Foo73Bar39Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo73Bar39Baz' --requests 'Foo73Bar39Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo73Bar39Baz' --requests 'Foo73Bar39Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo73Bar39Baz' --requests 'Foo73Bar39Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo73Bar39Baz' --dynamic-output-components 'Foo73Bar39Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo74Bar16Baz' --output-components 'Foo74Bar16Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo74Bar64Baz' --dynamic-output-components 'Foo74Bar64Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo75Bar40Baz' --output-components 'Foo75Bar40Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo76Bar65Baz' --output-components 'Foo76Bar65Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo76Bar68Baz' --dynamic-output-components 'Foo76Bar68Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo77Bar41Baz' --output-components 'Foo77Bar41Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo77Bar76Baz' --dynamic-output-components 'Foo77Bar76Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo79Bar21Baz' --dynamic-output-components 'Foo79Bar21Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo80Bar32Baz' --output-components 'Foo80Bar32Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo80Bar94Baz' --requests 'Foo80Bar94Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo80Bar94Baz' --requests 'Foo80Bar94Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo80Bar94Baz' --requests 'Foo80Bar94Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo80Bar94Baz' --requests 'Foo80Bar94Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo80Bar94Baz' --dynamic-output-components 'Foo80Bar94Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo82Bar46Baz' --requests 'Foo82Bar46Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo82Bar46Baz' --requests 'Foo82Bar46Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo82Bar46Baz' --requests 'Foo82Bar46Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo82Bar46Baz' --requests 'Foo82Bar46Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo82Bar46Baz' --output-components 'Foo82Bar46Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo83Bar26Baz' --dynamic-output-components 'Foo83Bar26Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo83Bar64Baz' --requests 'Foo83Bar64Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo83Bar64Baz' --requests 'Foo83Bar64Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo83Bar64Baz' --requests 'Foo83Bar64Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo83Bar64Baz' --requests 'Foo83Bar64Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo83Bar64Baz' --output-components 'Foo83Bar64Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo85Bar20Baz' --output-components 'Foo85Bar20Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo85Bar38Baz' --output-components 'Foo85Bar38Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo85Bar60Baz' --output-components 'Foo85Bar60Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo86Bar48Baz' --output-components 'Foo86Bar48Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo86Bar80Baz' --requests 'Foo86Bar80Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo86Bar80Baz' --requests 'Foo86Bar80Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo86Bar80Baz' --requests 'Foo86Bar80Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo86Bar80Baz' --requests 'Foo86Bar80Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo86Bar80Baz' --dynamic-output-components 'Foo86Bar80Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar26Baz' --requests 'Foo87Bar26Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar26Baz' --requests 'Foo87Bar26Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar26Baz' --requests 'Foo87Bar26Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar26Baz' --requests 'Foo87Bar26Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar26Baz' --output-components 'Foo87Bar26Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar84Baz' --requests 'Foo87Bar84Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar84Baz' --requests 'Foo87Bar84Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar84Baz' --requests 'Foo87Bar84Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar84Baz' --requests 'Foo87Bar84Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar84Baz' --dynamic-output-components 'Foo87Bar84Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo87Bar89Baz' --output-components 'Foo87Bar89Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo88Bar33Baz' --requests 'Foo88Bar33Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo88Bar33Baz' --requests 'Foo88Bar33Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo88Bar33Baz' --requests 'Foo88Bar33Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo88Bar33Baz' --requests 'Foo88Bar33Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo88Bar33Baz' --dynamic-output-components 'Foo88Bar33Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo88Bar84Baz' --dynamic-output-components 'Foo88Bar84Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo90Bar88Baz' --output-components 'Foo90Bar88Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo90Bar97Baz' --output-components 'Foo90Bar97Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo92Bar76Baz' --requests 'Foo92Bar76Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo92Bar76Baz' --requests 'Foo92Bar76Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo92Bar76Baz' --requests 'Foo92Bar76Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo92Bar76Baz' --requests 'Foo92Bar76Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo92Bar76Baz' --output-components 'Foo92Bar76Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo93Bar74Baz' --requests 'Foo93Bar74Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo93Bar74Baz' --requests 'Foo93Bar74Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo93Bar74Baz' --requests 'Foo93Bar74Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo93Bar74Baz' --requests 'Foo93Bar74Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo93Bar74Baz' --dynamic-output-components 'Foo93Bar74Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo94Bar36Baz' --requests 'Foo94Bar36Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo94Bar36Baz' --requests 'Foo94Bar36Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo94Bar36Baz' --requests 'Foo94Bar36Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo94Bar36Baz' --requests 'Foo94Bar36Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo94Bar36Baz' --output-components 'Foo94Bar36Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar25Baz' --requests 'Foo96Bar25Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar25Baz' --requests 'Foo96Bar25Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar25Baz' --requests 'Foo96Bar25Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar25Baz' --requests 'Foo96Bar25Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar25Baz' --dynamic-output-components 'Foo96Bar25Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar50Baz' --requests 'Foo96Bar50Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar50Baz' --requests 'Foo96Bar50Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar50Baz' --requests 'Foo96Bar50Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar50Baz' --requests 'Foo96Bar50Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar50Baz' --dynamic-output-components 'Foo96Bar50Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar59Baz' --requests 'Foo96Bar59Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar59Baz' --requests 'Foo96Bar59Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar59Baz' --requests 'Foo96Bar59Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar59Baz' --requests 'Foo96Bar59Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo96Bar59Baz' --output-components 'Foo96Bar59Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo97Bar24Baz' --requests 'Foo97Bar24Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo97Bar24Baz' --requests 'Foo97Bar24Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo97Bar24Baz' --requests 'Foo97Bar24Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo97Bar24Baz' --requests 'Foo97Bar24Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo97Bar24Baz' --output-components 'Foo97Bar24Baz'

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo97Bar61Baz' --dynamic-output-components 'Foo97Bar61Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo97Bar85Baz' --dynamic-output-components 'Foo97Bar85Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo98Bar18Baz' --requests 'Foo98Bar18Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo98Bar18Baz' --requests 'Foo98Bar18Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo98Bar18Baz' --requests 'Foo98Bar18Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo98Bar18Baz' --requests 'Foo98Bar18Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo98Bar18Baz' --dynamic-output-components 'Foo98Bar18Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar35Baz' --requests 'Foo99Bar35Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar35Baz' --requests 'Foo99Bar35Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar35Baz' --requests 'Foo99Bar35Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar35Baz' --requests 'Foo99Bar35Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar35Baz' --dynamic-output-components 'Foo99Bar35Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar76Baz' --requests 'Foo99Bar76Baz' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar76Baz' --requests 'Foo99Bar76Baz0' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar76Baz' --requests 'Foo99Bar76Baz1' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar76Baz' --requests 'Foo99Bar76Baz2' 

rig --assign-to-response --for-app 'FooBarBaz' --response 'Foo99Bar76Baz' --dynamic-output-components 'Foo99Bar76Baz' 

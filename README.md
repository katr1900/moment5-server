# Moment 5 REST web service
Detta är serverdelen till moment 5 i kursen Webbutveckling III. Det är en REST-tjänst byggt med PHP.

## Installation
Ladda upp filerna till din server. Öppna filen `ìncludes/courses.php` och konfigurera anslutningen till din mySQL-databas.

```
/* Konstanter för db-inställningar */
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBDATABASE", "courses");
```

Kör följande SQL-kod för att skapa databastabellen

```
CREATE TABLE `courses` (
  `Id` int(11) NOT NULL,
  `Code` text NOT NULL,
  `Progression` text NOT NULL,
  `Name` text NOT NULL,
  `CourseSyllabus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `courses`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `courses`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```

## DEMO
En länk till en demotjänst finns [här](http://studenter.miun.se/~katr1900/writeable/dt173g/moment5/index.php).

## Användning

### Hämta alla kurser

Skicka ett GET-anrop till http://studenter.miun.se/~katr1900/writeable/dt173g/moment5/index.php

### Spara ny kurs

Skicka ett POST-anrop till http://studenter.miun.se/~katr1900/writeable/dt173g/moment5/index.php med data i JSON-format. Exempel:

```
{
	"code": "kurskod",
	"name": "kursnamn",
	"progression": "A",
	"coursesyllabus": "http://link-to-course"
}
```

### Uppdatera en kurs
Skicka ett PUT-anrop till http://studenter.miun.se/~katr1900/writeable/dt173g/moment5/index.php med data i JSON-format. Exempel:

```
{
    "id": 12,
	"code": "kurskod",
	"name": "kursnamn",
	"progression": "A",
	"coursesyllabus": "http://link-to-course"
}
```

### Ta bort en kurs
Skicka ett DELETE-anrop till http://studenter.miun.se/~katr1900/writeable/dt173g/moment5/index.php med data i JSON-format. Exempel:

```
{
    "id": 12
}
```
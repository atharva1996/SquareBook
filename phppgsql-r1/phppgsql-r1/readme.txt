PHPPgSQL
========

PHPPgSQL is a PHP database access class for PostgreSQL with state of the art
performance enhancements and user interface. It is designed to be as easy to
use as possible and hide all the complexities away.

Features
--------

PHPPgSQL has the following features important for modern web applications:

 * Provides an easy to use and intuitively understandable Iterator API for
   retrieving database data.
 * Uses prepared statements on the PostgreSQL database backend side, providing
   performance boosts for both repeatable queries with changing arguments and
   in case "persistent" connections are used with PHP, all other queries.
 * Uses `memcached` as a query cache to store and retrieve frequently queried
   data, reducing database load.

Dependencies
------------

PHPPgSQL depends on the following PHP modules / extensions:

 * pgsql
 * pcre
 * memcache

 Class documentation
-------------------

----------------------------------------------
SQL query class; implements Iterator for row fetching and tries too hard to perform
smart cacheing. The first argument is the parametrized SQL query with $1,$2,... as
parameter plceholders. The other arguments are the required parameters.
 
The function will fail when the number of arguments reaches about 20.
 
Usage:
	$q = new PHPPgSQL([flags,] SQL [, arg0, arg1...])
 
Optional flag is one of:
	* PHPPgSQL::NO_CACHE		- Don't retrieve the results of this query from the cache
	* PHPPgSQL::PREPARE_ONLY 	- Don't execute the SQL query in the constructore - use execute() method instead

The only accessible field is reccount - containing the number of records returned or affected by the query.
For SELECT queries, PHPPgSQL implements the Iterator interface for iterating over returned rows
----------------------------------------------

All methods of PHPPgSQL objects will throw exceptions based on the 
`PHPPGSQLException` exception class.


Configuration
-------------

The library include file, phppgsql.php, expects the following variables to be
set before it is included:

[source,php]
----------------------------------------------
$PHPPGSQL_DB_CONNECTION = 'dbname=idx user=idx';
$PHPPGSQL_DB_CACHE_TIMEOUT = 10;
$PHPPGSQL_MEMCACHED_SERVER = 'localhost';
----------------------------------------------

Additionally, the following variables can override the built-in defaults:

[source,php]
----------------------------------------------
$PHPPGSQL_MEMCACHED_PORT = 11211;
$PHPPGSQL_ENCODING = 'UTF-8';
----------------------------------------------


Examples
--------

[source,php]
----------------------------------------------
$q = new PHPPgSQL("SELECT comment FROM forum WHERE forum_id=$1 AND user_id=$2", $forum_id, $uid);
foreach ($q as $row)
	var_dump($row);
echo "There are {$q->reccount} records.\n";
----------------------------------------------

Executes a SELECT query and dumps the result records.

[source,php]
----------------------------------------------
foreach (new PHPPgSQL("SELECT * FROM table") as $row)
	var_dump($row);
----------------------------------------------

Iterates over a query result without a temporary variable.

[source,php]
----------------------------------------------
new PHPPgSQL("BEGIN");
$q = new PHPPgSQL("INSERT INTO table (id, name) VALUES ($1, $2)");
for ($i = 0; $i < 10; $i++)
	$q->execute($i, "name$i");
new PHPPgSQL("COMMIT");
----------------------------------------------

Inserts 10 records into the database, within a transaction.

[source,php]
----------------------------------------------
$q = new PHPPgSQL(PHPPgSQL::PREPARE_ONLY, "SELECT a,b,c FROM t1 JOIN t2 ON t1.x=t2.y JOIN t3 ON t1.w=t3.z JOIN t4 ON t3.u=t2.p WHERE y=$1");
for ($i = 0; $i < 10; $i++)
	$q->execute($i);
----------------------------------------------

Perform 10 SELECTs with complex JOINs by taking advantage of parametrized
queries. The database query plans will be cached on object creation and
subsequent query invocations will be executed with the cached plan. Plan
caching can significantly improve performance of complex queries.


<?php

namespace RectorPrefix20210526;

if (\interface_exists('Tx_Extbase_Persistence_PersistenceManagerInterface')) {
    return;
}
interface Tx_Extbase_Persistence_PersistenceManagerInterface
{
}
\class_alias('Tx_Extbase_Persistence_PersistenceManagerInterface', 'Tx_Extbase_Persistence_PersistenceManagerInterface', \false);
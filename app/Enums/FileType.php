<?php

namespace App\Enums;

enum FileType
{
  case IMPORTADO = 1;
  case PROCESSADO = 2;
  case DELETADO = 3;

  public function getFileTypeDescription()
  {
    return match ($this) {
      self::IMPORTADO => 'Importado',
      self::PROCESSADO => 'Processado',
      self::DELETADO => 'Deletado'
    };
  }
}
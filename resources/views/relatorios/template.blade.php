<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>{{ $titulo }}</h2>
    @if ($dados->isNotEmpty()) 
        <table>
            <thead>
                <tr>
                    @foreach ($dados->first()->getAttributes() as $campo => $valor)
                        <th>{{ ucfirst(str_replace('_', ' ', $campo)) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $linha)
                    <tr>
                        @foreach ($linha->getAttributes() as $valor)
                            <td>{{ $valor }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center">Nenhum dado encontrado para exibição.</p>
    @endif
</body>
</html>

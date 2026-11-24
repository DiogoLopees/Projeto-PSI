package com.example.sana_android;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.example.sana_android.databinding.ActivitySettingsBinding;

public class SettingsActivity extends AppCompatActivity {

    private ActivitySettingsBinding binding;
    public static final String PREFS_NAME = "SanaPrefs";
    public static final String KEY_IP = "server_ip";
    public static final String KEY_PORT = "server_port";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivitySettingsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        SharedPreferences prefs = getSharedPreferences(PREFS_NAME, Context.MODE_PRIVATE);

        // Carregar valores já guardados (se existirem)
        binding.etServerIp.setText(prefs.getString(KEY_IP, "10.0.2.2"));
        binding.etServerPort.setText(prefs.getString(KEY_PORT, "8080"));

        binding.btnSave.setOnClickListener(v -> {
            String ip = binding.etServerIp.getText().toString().trim();
            String port = binding.etServerPort.getText().toString().trim();

            if (ip.isEmpty() || port.isEmpty()) {
                Toast.makeText(this, "Preenche o IP e a Porta do servidor.", Toast.LENGTH_SHORT).show();
                return;
            }

            prefs.edit()
                    .putString(KEY_IP, ip)
                    .putString(KEY_PORT, port)
                    .apply();

            Toast.makeText(this, "Configurações guardadas!", Toast.LENGTH_SHORT).show();
            finish();
        });
    }
}
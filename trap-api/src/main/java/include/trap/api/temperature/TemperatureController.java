package include.trap.api.temperature;

import java.time.LocalDateTime;

import org.joda.time.Instant;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin("*")
@RequestMapping("/temperature")
public class TemperatureController {

	@Autowired
	private TemperatureRepository repository;

	@GetMapping
	public ResponseEntity<Void> create(@RequestParam String tag, @RequestParam String value) {
		Temperature entry = new Temperature();
		entry.setTag(tag);
		entry.setValue(Double.valueOf(value));
		entry.setId(Instant.now().getMillis());
		entry.setTimestamp(LocalDateTime.now());
		repository.save(entry);
		return new ResponseEntity<>(HttpStatus.OK);
	}
}

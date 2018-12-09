package include.trap.api;

import java.time.LocalDateTime;

import org.joda.time.Instant;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin("*")
public class TrapEntryController {

	@Autowired
	private TrapEntryRepository repository;

	@PostMapping
	public ResponseEntity<Void> createWithPostMethod(@RequestBody TrapEntry entry) {
		entry.setId(Instant.now().getMillis());
		entry.setDateTime(LocalDateTime.now());
		repository.save(entry);
		return new ResponseEntity<>(HttpStatus.CREATED);
	}

	public ResponseEntity<Void> createWithGetMethod(@RequestParam String t, @RequestParam String c) {
		TrapEntry entry = new TrapEntry();
		entry.setTrapName(t);
		entry.setPragueCount(Long.valueOf(c));
		entry.setId(Instant.now().getMillis());
		entry.setDateTime(LocalDateTime.now());
		repository.save(entry);
		return new ResponseEntity<>(HttpStatus.CREATED);
	}
}
